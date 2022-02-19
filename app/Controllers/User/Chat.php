<?php


namespace app\Controllers\User;


class Chat extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
       return redirect()->to('https://jivo.chat/it3o55TeZp',null, 'refresh');

    }
}
