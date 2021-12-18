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
        return $this->_renderPage('Dashboard/index2', $data);
    }

}
