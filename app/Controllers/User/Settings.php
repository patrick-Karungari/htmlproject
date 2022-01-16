<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

use Exception;
use Twilio\Rest\Client;

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
     public function sendcode($number){
         try{
             $sid = "AC2dbbc0162feeaf74875f51cd73e63d83";
            $token = "cfb446060025a096e7bc7f3d3866e34e";
            $twilio = new Client($sid, $token);
            $verification = $twilio->verify->v2->services("VAfd7fed898589cda55145fd0070aa27ad")
                ->verifications
                ->create('+'.$number, "sms");
            $data = [
                'first_name' => trim($this->request->getPost('fname')),
                'last_name' => trim($this->request->getPost('lname')),
            ];
            

           
         }catch(\Exception $exception){
             return 'error';
         }
        

    }
    public function verifycode($number,$code){
        try{
            $sid = "AC2dbbc0162feeaf74875f51cd73e63d83";
            $token = "cfb446060025a096e7bc7f3d3866e34e";
            $twilio = new Client($sid, $token);
            $verification_check = $twilio->verify->v2->services("VAfd7fed898589cda55145fd0070aa27ad")
                ->verificationChecks
                ->create($code, // code
                ["to" => '+'.$number]
            );
            $auth = new \App\Libraries\Auth();
            $data = [
                'phone' => $number,
                'phone_verified' => ($verification_check->status === 'approved') ? 1 : 0,
            ];

            if ($auth->update($this->current_user->id, $data)){
                return $verification_check->status;
            }
            return 'error';
            

        }catch(\Exception $exception){
            return 'error';
        }
       

        

    }
}
