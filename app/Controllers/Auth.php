<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers;

use App\Models\Referrals;
use App\Models\Users;
use Config\Services;

class Auth extends BaseController
{
    /**
     * @var \App\Libraries\Auth
     */
    private $auth;
    private $authModel;
    private $email;
    public $secure_key;
    private $config;

    public function __construct()
    {
        $this->auth = new \App\Libraries\Auth();
        $this->authModel = new \App\Models\AuthModel();
        $this->email = new \App\Libraries\Mailer();
        $this->config = config('Auth');
        $this->session = \Config\Services::session();
        $this->secure_key = $this->secure_request_key(32);

        $this->data = [
            'site_title' => "Authentication",
            'site_description' => 'Login to this system',
        ];
    }

    public function index()
    {
        return $this->login();
    }

    public function login()
    {
        if ($this->request->getPost()) {

            $username = strtolower(trim($this->request->getPost('username')));
            $password = $this->request->getPost('password');
            $remember = (bool) $this->request->getPost('remember_me');

            if (!$username || !$password || $username === '' || $password === '') {
                return redirect()->back()->withInput()->with('error', "Please enter your email and password");
            }
            $login = $this->auth->login($username, $password, $remember);
            if ($login) {
                do_action('login_successful', $this->auth->getUserId());
                do_action('user_login_successful', $this->auth->getUserId());

                if ($this->auth->isAdmin()) {
                    return redirect()->to(site_url('admin/dashboard'));
                }

                return redirect()->to(site_url('user/account'));
            } else {
                if (in_array("Account is inactive", $this->auth->errorsArray(), true)) {
                    $data = $this->auth->getData();
                    //$this->secure_key = $this->secure_request_key(32);
                    //$data['security'] =  $this->secure_key;
                    //dd($data);
                    return $this->_renderPage('email/wait_verification_email', $data);

                }

                return redirect()->back()->withInput()->with('error', $this->auth->errorsArray());
            }
        }

        return $this->_renderPage('login', $this->data);
    }

    public function terms()
    {
        return $this->_renderPage('terms', $this->data);
    }

    public function activate(int $id, string $code = '')
    {

        $activation = false;
        //dd($code);

        if ($code) {
            $activation = $this->authModel->activate($id, $code);
        } else if ($this->auth->isAdmin()) {
            $activation = $this->authModel->activate($id);
        }
        if ($activation) {
            // redirect them to the auth page
            return redirect()->to(site_url('auth'))->with('success', "Account activation successful");

        } else {
            // redirect them to the forgot password page
            return redirect()->to(site_url('auth'))->with('error', "An error occurred");

        }

    }

    public function mail_verify()
    {
        $adminEmail = $this->config->adminEmail;
        if ($this->request->getPost() || !empty($this->session->getFlashdata('data'))) {
            if (!empty($this->session->getFlashdata('data'))) {
                $flashdata = $this->session->getFlashdata('data');
                //dd($flashdata);
                $id = $flashdata['user']['id'];
                $email = $flashdata['user']['email'];
                //$flash_key = $flashdata['security'];

            } else {
                if ($this->request->getPost()) {
                    $email = $this->request->getPost('email');
                    $id = $this->request->getPost('id');
                   // $flash_key = $this->request->getPost('security');
                    //dd($flash_key);
                    //$this->secure_key = $this->secure_request_key(32);

                } else {
                    return redirect()->to(site_url('auth'))->with('error', "An error occurred");

                }
            }

            // $state = false;

            //if (strcmp($flash_key, $this->secure_key) == 0 ){
            //  $state = true;
            // }

            $activation = false;
            $data['user'] = ['email' => $email, 'id' => $id];
            //dd($id);

            if ($id) {
                $activation = $this->authModel->deactivate($id);
                if ($activation) {
                    //$data['user'] = ['email' => $email, 'id' => $id];
                    // dd($data);

                    $activationCode = $this->authModel->activationCode;
                    $identity = $this->config->identity;
                    $user = $this->authModel->user($id);

                    $data2 = [
                        'identity' => $user->{$identity},
                        'id' => $user->id,
                        'email' => $email,
                        'supportEmail' => $adminEmail,
                        'name' => $user->first_name,
                        'activation' => $activationCode,
                    ];

                    if ($this->auth->sendMail($data2, $email)) {
                        // $this->secure_key = $this->secure_request_key(32);
                        // $data['security'] = $this->secure_key;
                        return redirect()->to(site_url('auth'))->withInput()->with('success', "Seccessfully Sent New Ativation Email");

                    } else {
                        // redirect them to the forgot password page
                        return redirect()->to(site_url('auth'))->with('error', "An error occurred");

                    }
                }

            }
            return redirect()->to(site_url('auth'))->with('error', "An error occurred. Try again later");

        }
        return redirect()->to(site_url('auth'))->with('error', "An error occurred. Try again later");

    }

    public function forgot_password()
    {
        $this->data['site_title'] = "Forgot password";
        $this->data['site_description'] = "Recover your password";

        if ($this->request->getPost()) {
            $username = strtolower(trim($this->request->getPost('username')));

            if ($this->auth->forgottenPassword($username) === true) {
                return redirect()->back()->with('success', "A link to reset your password has been sent to your E-Mail address");
            }

            return redirect()->back()->withInput()->with('error', $this->auth->errorsArray());
        }

        return $this->_renderPage('forgot_password', $this->data);
    }

    public function reset_password($code = false)
    {
        if (!$code) {
            return redirect()->to(site_url('auth'))->with('error', "Invalid password reset link");
        }

        $auth = new \App\Libraries\Auth();
        $user = $auth->forgottenPasswordCheck($code);

        if (!$user) {
            return redirect()->back()->with('error', "Sorry! We couldn't find your account");
        }

        if ($this->request->getPost()) {
            // dd($this->request->getPost());
            $validation = \Config\Services::validation();
            $validation->setRule('password', "New Password", 'required|matches[confirm_password]|min_length[6]');
            $validation->setRule('confirm_password', "Confirm Password", 'required');

            if ($validation->withRequest($this->request)->run()) {
                if ($this->request->getPost('userid') != $user->id) {
                    $auth->clearForgottenPasswordCode($user->email);
                    return redirect()->to(site_url('auth'))->with('error', "Hack attempt failed");
                } else {
                    if ($auth->resetPassword($user->email, $this->request->getPost('password'))) {
                        return redirect()->to(site_url('auth'))->with('success', "Password was reset successfully");
                    } else {
                        return redirect()->to(site_url('auth'))->with('error', "An error occurred");
                    }
                }
            } else {
                return redirect()->back()->with('error', $validation->getErrors());
            }
        } else {
            $this->data['site_title'] = "Reset Password";
            $this->data['user'] = $user;

            return $this->_renderPage('reset_password', $this->data);
        }
    }

    public function register()
    {
        if ($this->request->getPost()) {

            $ref = session()->get('ref');

            $validation = \Config\Services::validation();
            $validation->setRule('username', "Username", 'trim|required|min_length[3]|is_unique[users.username]');
            $validation->setRule('fname', "First Name", 'trim|required|min_length[3]');
            $validation->setRule('lname', "Last Name", 'trim|required|min_length[3]');
            $validation->setRule('phone', "Phone Number", 'trim|required|min_length[10]|max_length[10]|is_unique[users.phone]');
            $validation->setRule('email', "Email Address", 'trim|required|valid_email|is_unique[users.email]');
            $validation->setRule('password', "Password", 'trim|required|min_length[6]|matches[confirm_password]');
            $validation->setRule('confirm_password', "Confirm Password", 'trim|required|min_length[6]');
            if ($validation->withRequest($this->request)->run() === true) {
                $auth = new \App\Libraries\Auth();

                $username = strtolower(trim($this->request->getPost('username')));
                $first_name = trim($this->request->getPost('fname'));
                $last_name = trim($this->request->getPost('lname'));
                $phone = trim($this->request->getPost('phone'));
                $email = trim($this->request->getPost('email'));
                $password = $this->request->getPost('password');

                if ($auth->identityCheck($email) || $auth->identityCheck($phone) || $auth->identityCheck($username)) {
                    return redirect()->back()->with('error', "Username, Email or phone number already registered");
                }

                if ($ref) {
                    if (!is_numeric($ref)) {
                        $referer = (new Users())->where('username', $ref)->get()->getFirstRow();
                        $ref = $referer->id;
                    }
                }

                $additional_data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone' => $phone,
                    'referred_by' => (isset($ref) && is_numeric($ref)) ? $ref : null,
                ];
                if ($newID = $auth->register($username, $password, $email, $additional_data, [2])) {

                    $referral = new Referrals();
                    $xData = [
                        'user' => $newID,
                        'ref' => $ref,
                        'status' => 'pending',
                    ];
                    try {
                        $referral->save($xData);
                    } catch (\ReflectionException $e) {
                        return redirect()->back()->with('error', $e->getMessage());
                    }
                    $data = ['user' => ['email' => $email, 'id' => $newID]];

                    return redirect()->to(site_url('auth/mail_verify'))->with('data', $data);
                } else {
                    return redirect()->back()->with('error', $auth->errorsArray());
                }
            } else {
                return redirect()->back()->with('error', $validation->getErrors());
            }
        }

        $ref = $this->request->getGet('ref');
        if (isset($ref)) {
            session()->set('ref', $ref);
        }
        return $this->_renderPage('register', $this->data);
    }

    public function logout()
    {
        $this->auth->logout();

        return redirect()->to(site_url('/'));
    }

    public function secure_request_key($length)
    {
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }
        return strtoupper($random_string);
    }

    public function _renderPage($view, $data = []): string
    {
        $data = array_merge($this->data, $data);
        //dd($data);
        $data['_html_content'] = view('Auth/' . $view, $data);

        return view('Auth/layout', $data);
    }
}
