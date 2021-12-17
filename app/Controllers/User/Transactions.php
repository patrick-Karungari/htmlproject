<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\User;


class Transactions extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "My Transactions";
    }

    public function index()
    {

        return $this->_renderPage('Transactions/index', $this->data);
    }
}