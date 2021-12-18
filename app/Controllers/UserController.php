<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers;

class UserController extends BaseController
{
    public $current_user;

    public function __construct()
    {
        $this->current_user = (new \App\Libraries\Auth())->user();
        $this->data = [
            'site_title' => "Dashboard",
            'site_description' => "user dashboard",
            'current_user' => $this->current_user,
        ];
    }

    public function _renderPage($view, $data = []): string
    {
        $data = array_merge($this->data, $data);
        $data['_html_content'] = view('User/' . $view, $data);

        return view('User/layout', $data);
    }
}
