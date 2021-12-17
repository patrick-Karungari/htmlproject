<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\Admin;


class Settings extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Settings";
    }

    public function index()
    {
        if ($this->request->getPost()) {

            foreach ($this->request->getPost() as $item=>$value) {
                update_option($item, $value);
            }

            return redirect()->back()->with('success', "Settings updated successfully");
        }
        return $this->_renderPage('Settings/system', $this->data);
    }
    public function system()
    {
        if ($this->request->getPost()) {

            foreach ($this->request->getPost() as $item=>$value) {
                update_option($item, $value);
            }

            return redirect()->back()->with('success', "Settings updated successfully");
        }
        return $this->_renderPage('Settings/system', $this->data);
    }
    public function profile()
    {
        if ($this->request->getPost()) {
            $validation = \Config\Services::validation();
            $validation->setRule('fname', "First Name", 'trim|required|min_length[3]');
            $validation->setRule('lname', "Last Name", 'trim|required|min_length[3]');
            $validation->setRule('avatar', "Profile Image", 'is_image[avatar]');
            if  ($validation->withRequest($this->request)->run() === TRUE) {
                $auth = new \App\Libraries\Auth();
                $data = [
                    'first_name'    => trim($this->request->getPost('fname')),
                    'last_name'     => trim($this->request->getPost('lname'))
                ];

                $file = $this->request->getFile('avatar');
                if ($file) {
                    $newName = $file->getRandomName();
                    if ($file->move(FCPATH . 'uploads/avatars/', $newName)) {
                        $data['avatar'] = $newName;
                        @unlink(FCPATH.'uploads/avatars/'.$this->current_user->avatar);
                    }
                }

                if ($auth->update($this->current_user->id, $data)) {
                    return redirect()->back()->with('success', "Profile updated successfully");
                } else {
                    return redirect()->back()->with('error', "Something went wrong");
                }
            } else {
                return redirect()->back()->with('error', $validation->getErrors());
            }
        }

        return $this->_renderPage('Settings/profile', $this->data);
    }

    public function mpesa()
    {
        if ($this->request->getPost()) {

            foreach ($this->request->getPost() as $item=>$value) {
                update_option($item, $value);
            }

            return redirect()->back()->with('success', "Settings updated successfully");
        }

        return $this->_renderPage('Settings/c2b', $this->data);
    }

    public function b2c()
    {
        if ($this->request->getPost()) {

            foreach ($this->request->getPost() as $item=>$value) {
                update_option($item, $value);
            }

            return redirect()->back()->with('success', "Settings updated successfully");
        }

        return $this->_renderPage('Settings/b2c', $this->data);
    }

    public function email()
    {
        if ($this->request->getPost()) {

            foreach ($this->request->getPost() as $item=>$value) {
                update_option($item, $value);
            }

            return redirect()->back()->with('success', "Settings updated successfully");
        }

        return $this->_renderPage('Settings/email', $this->data);
    }
}