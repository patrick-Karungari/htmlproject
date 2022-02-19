<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
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
