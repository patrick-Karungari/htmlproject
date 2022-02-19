<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers;
use App\Entities\User;

class UserController extends BaseController
{
    public $current_user;
    public $currency;

    public function __construct()
    {
        $this->currency = (new \App\Libraries\Auth())->user()->usermeta('currency');
        $this->current_user = (new \App\Libraries\Auth())->user();
        //dd($this->currency);
        $this->data = [
            'site_title' => "Dashboard",
            'site_description' => "user dashboard",
            'current_user' => $this->current_user,
            'currency' => $this->currency,
        ];
    }

    public function _renderPage($view, $data = []): string
    {
        $data = array_merge($this->data, $data);
        $data['_html_content'] = view('User/' . $view, $data);

        return view('User/layout', $data);
    }
}
