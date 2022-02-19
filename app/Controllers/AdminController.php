<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers;

class AdminController extends BaseController
{
    /**
     * @var \App\Libraries\Auth
     */
    public $auth;

    public function __construct()
    {
        $this->auth = new \App\Libraries\Auth();

        if (!$this->auth->isAdmin()) {
            $this->auth->logout();
            return redirect()->to(site_url('auth'))->with('error', "Please login as admin to continue");
        }
    }

    public function _renderPage($view, $data = [])
    {
        /* $data['headscripts'] = array('assets/vendors/js/forms/select/select2.full.min.js',
        'assets/vendors/js/editors/quill/katex.min.js',
        'assets/vendors/js/editors/quill/highlight.min.js',
        'assets/vendors/js/editors/quill/quill.min.js',
        'assets/js/scripts/pages/page-blog-edit.js');*/
        $data = array_merge($this->data, $data);
        $data['_html_content'] = view('Admin/' . $view, $data);
        $data['current_user'] = $this->auth->user();

        return view('Admin/layout2', $data);
    }
}
