<?php


namespace app\Controllers\Admin;


class Email extends \App\Controllers\AdminController
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
