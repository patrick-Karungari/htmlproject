<?php


namespace app\Controllers\User;


class Email extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): string
    {
        return $this->_renderPage('email/index', $this->data);
    }
}
