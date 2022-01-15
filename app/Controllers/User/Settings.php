<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

class Settings extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Profile Settings";

    }

    public function index()
    {
        if ($this->request->getPost()) {
            $validation = \Config\Services::validation();
            $validation->setRule('fname', "First Name", 'trim|required|min_length[3]');
            $validation->setRule('lname', "Last Name", 'trim|required|min_length[3]');
            $validation->setRule('avatar', "Profile Image", 'is_image[avatar]');
            if ($validation->withRequest($this->request)->run() === true) {
                $auth = new \App\Libraries\Auth();
                $data = [
                    'first_name' => trim($this->request->getPost('fname')),
                    'last_name' => trim($this->request->getPost('lname')),
                ];

                $file = $this->request->getFile('avatar');
                if ($file) {
                    $newName = $file->getRandomName();
                    if ($file->move(FCPATH . 'uploads/avatars/', $newName)) {
                        $data['avatar'] = $newName;
                        @unlink(FCPATH . 'uploads/avatars/' . $this->current_user->avatar);
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

        return $this->_renderPage('Settings/index2', $this->data);
    }

    public function password()
    {
        if ($this->request->getPost()) {
            $auth = new \App\Libraries\Auth();
            $oldPass = $this->request->getPost('password');
            $newpass = $this->request->getPost('new_password');
            $confirmPass = $this->request->getPost('confirm_new_password');

            if (strlen($newpass) < 6 || $newpass != $confirmPass) {
                return redirect()->back()->with('error', "New password must match and must be at least 6 characters long");
            }

            if ($auth->verifyPassword($oldPass, $this->current_user->password)) {
                $pass = password_hash($newpass, PASSWORD_BCRYPT, ['cost' => (new \Config\Auth())->bcryptDefaultCost]);
                try {
                    $res = \Config\Database::connect()->table('users')->set('password', $pass)->where('id', $this->current_user->id)->update();
                    if ($res) {
                        return redirect()->back()->with('success', "Password updated successfully");
                    }
                } catch (\ReflectionException $e) {
                    return redirect()->back()->with('error', "Something went wrong");
                }
            } else {
                return redirect()->back()->with('error', "Current password is incorrect");
            }

            return redirect()->back()->with('error', "Failed to change password. Please try again");
        }

        return redirect()->back()->with('error', "Invalid request");
    }
}
