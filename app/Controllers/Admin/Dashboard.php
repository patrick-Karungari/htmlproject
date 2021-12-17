<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\Admin;


use App\Controllers\AdminController;

class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index(): string
    {
        $data['current_user'] = $this->auth->user();
        $data['headscripts'] = array('assets/js/scripts/pages/dashboard-ecommerce.js','assets/vendors/js/charts/apexcharts.min.js');
        return $this->_renderPage('Dashboard/index2', $data);
    }
}