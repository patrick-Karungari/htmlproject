<?php

namespace app\Controllers\User;

class Notifications extends \App\Controllers\UserController
{
    public function index()
    {

        return $this->_renderPage('Notifications/index', $this->data);
    }
}