<?php


namespace app\Controllers\User;


class Chat extends \App\Controllers\UserController
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
