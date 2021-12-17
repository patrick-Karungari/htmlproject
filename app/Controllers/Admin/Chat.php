<?php


namespace app\Controllers\Admin;


class chat extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): string
    {
        return $this->_renderPage('Chat/index', $this->data);
    }
}