<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;

class Investments extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "User Investments";
    }

    public function index()
    {
        return $this->_renderPage('Investments/index', $this->data);
    }
}
