<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

use App\Libraries\MpesaLibrary;
use Exception;
use App\Libraries\Converter;

class Deposits extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "My Deposits";
        $this->data['deposit'] = $this;

        
    }

    public function index(): string
    {

        return $this->_renderPage('Deposits/index2', $this->data);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $phone = $this->request->getPost('phone');
            $amount = $this->request->getPost('amount');

            //return redirect()->back()->with('error', "Temporarily disabled. We are fixing the erroneous double deposits incurred from yesterday");

            if (!is_numeric($amount) || $amount < 1) {
                return redirect()->back()->with('error', "Amount should be more than Kshs 0");
            }

            $amount = ceil($amount);

            if ((strlen($phone) != 10)) {
                return redirect()->back()->with('error', "Invalid phone number");
            }
            $phone = substr_replace($phone, '254', 0, 1);

            $c2b = new MpesaLibrary(get_option('mpesa_env'));
            $c2b->lnmo_callback_url = site_url('api/deposit/' . $this->current_user->id . '/' . env("MPESA_KEY", "kurtAngl3numB3ROnE"), 'https');
            //$c2b->lnmo_callback_url = "https://dev.pkarungari.co.ke/cb.php";
            try {
                $response = $c2b->stkPush($amount, $phone, env('MPESA_PREFIX', "USER") . $this->current_user->id);
                if ($response = json_decode($response)) {
                    if ($response->ResponseCode == '0') {
                        return redirect()->to(site_url('user/deposits'))->with('success', "Please authorize the transaction by entering your M-Pesa PIN in your phone");
                    } else {
                        return redirect()->back()->with('error', "Something went wrong");
                    }
                } else {
                    return redirect()->back()->with('error', "Something went wrong");
                }
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        $this->data['site_title'] = "Deposit Funds";
        return $this->_renderPage('Deposits/create', $this->data);
    }
    public function getDepo($id)
    {

//dd($id);
       $deposits = (new \App\Models\Deposits())->where('user', $id)->orderBy('date', 'DESC')->findAll();
       $deposits = json_encode($deposits);
       $deposits = json_decode($deposits, TRUE);
        $converter = new Converter();


       $i = 0;

       foreach($deposits as $deposit) {
           $user =  ['id' => $deposit['user']['id'], 
                     'first_name' =>  $deposit['user']['first_name'],
                     'last_name' => $deposit['user']['last_name'],
                     'avatar' => $deposit['user']['avatar'],
                    'username' => $deposit['user']['username'] ];
                     
            $deposits[$i]['user'] = $user;
            $deposits[$i]['amount'] = $converter->convertoLocal($deposit['amount'], $this->currency);
            $i++;

            
          
       }
       //dd($deposits);
       $data ['data'] = $deposits;
       return json_encode($data);

    }
    public function getTotalDeposits($id){
        $converter = new Converter();
        $model = new \App\Models\Deposits();
        $dateStart = $this->request->getGet('start');
        $dateEnd = $this->request->getGet('end');
        if ($dateStart && $dateEnd) { 
            $amountCOB = $model->selectSum('amount', 'totalAmount')->where('user', $id)->where('date >=', $dateStart)->where('date <=', $dateEnd)->get()->getFirstRow('object')->totalAmount;           
           // echo $converter->convertoLocal($amountCOB, $this->currency);
            echo $amountCOB;
            return;
        }
        return "null";

    }
}
