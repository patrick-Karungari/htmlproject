<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;

use App\Controllers\AdminController;

class Admin extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): string
    {
        $data['current_user'] = $this->auth->user();
       
        $data['headscripts'] = array('assets/js/scripts/pages/dashboard-ecommerce.js', 'assets/vendors/js/charts/apexcharts.min.js');

        return $this->_renderPage('Dashboard/index2', $data);
    }
   

}
