<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
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