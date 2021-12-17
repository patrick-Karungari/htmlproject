<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\User;


use App\Libraries\MpesaLibrary;
use Exception;

class Deposits extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "My Deposits";
    }

    public function index(): string
    {

        return $this->_renderPage('Deposits/index', $this->data);
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
            $c2b->lnmo_callback_url = site_url('api/deposit/'.$this->current_user->id.'/'.env("MPESA_KEY", "kurtAngl3numB3ROnE"), 'https');
            //$c2b->lnmo_callback_url = "https://dev.bennito254.com/cb.php";
            try {
                $response = $c2b->stkPush($amount, $phone, env('MPESA_PREFIX', "USER").$this->current_user->id);
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
}