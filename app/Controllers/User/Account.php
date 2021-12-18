<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

class Account extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->_renderPage('Account/index', $this->data);
    }
}
