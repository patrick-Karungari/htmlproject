<?php


namespace App\Controllers\Admin;


use App\Controllers\AdminController;

class Profile extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): string
    {
        return $this->_renderPage('Profile/index', $this->data);
    }
}