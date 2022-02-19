<?php


namespace app\Controllers\Admin;


class Chat extends \App\Controllers\AdminController
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
