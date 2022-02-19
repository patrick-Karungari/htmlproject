<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;
use Carbon\Carbon;

class Investments extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "User Investments";
    }

    public function index()
    {
        return $this->_renderPage('Investments/index', $this->data);
    }
      public function getTotalInvestment($id)
    {
        $model = new \App\Models\Investments();
        $dateStart = $this->request->getGet('start');
        $dateEnd = $this->request->getGet('end');
        if( $dateStart &&  $dateEnd  ){
            $start_of_day = Carbon::parse($dateStart)->startOfDay()->getTimestamp();
            $end_of_day = Carbon::parse($dateEnd)->endOfDay()->getTimestamp();
            $amountCOB = $model->selectSum('total', 'totalAmount')->where('end_time >=', $start_of_day)->where('end_time <=', $end_of_day)->get()->getFirstRow('object')->totalAmount;
            return $amountCOB;
        }
        return "null";

    }
      public function ginv()
    {      
       
            $users = ((new \App\Models\Investments()))->select('id, plan, user, amount, return, total, status, created_at, end_time')->orderBy('id', 'DESC')->findAll();
            $data['data'] = $users;
            //dd($data);
            return json_encode($data);   
    }
}
