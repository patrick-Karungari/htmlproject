<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;

class Users extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'site_title' => "Users",
        ];
    }

    public function index(): string
    {

        return $this->_renderPage('Users/index', $this->data);
    }
    public function redirect()
    {

        return redirect()->back();
    }
    public function pay(): string
    {

        return $this->_renderPage('Pay/index', $this->data);
    }

    public function view($id)
    {
        $user = (new \App\Models\Users())->Where('username', $id)->find();
        //dd($user);
        $user = $user[0];

        if (!$user) {
            return redirect()->back()->with('error', "User does not exist");
        }

        $this->data['site_title'] = $user->name;
        $this->data['user'] = $user;
        return $this->_renderPage('Users/view2', $this->data);
    }

    public function delete($id)
    {
        $model = new \App\Models\Users();
        if ($model->delete($id)) {
            return redirect()->back()->with('success', "User deleted successfully");
        }

        return redirect()->back()->with('error', "Failed to delete the user");
    }

    /**
     * @return false|string|string[]
     */
    public function gtsr()
    {

        $users = (new \App\Libraries\Auth())->select('users.id, username, email, phone, account, registration, referred_by, first_name, last_name, avatar')->users(2);
        $i = 0;
        $n_users = array();
        foreach ($users as $user) {
            $referrals = count((new \App\Models\Referrals())->where('user', $user->id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll());
            $array = json_decode(json_encode($user), true);
            $n_users[$i++] = array_merge($array, array("referrals" => $referrals));
        }

        $data['data'] = $n_users;
        //dd($data);
        echo json_encode($data);

    }

    public function gtrx()
    {

        $id = $this->request->getPost('id');
        //dd($id);

        if ($this->request->getPost('id')) {
            $users = ((new \App\Models\Transactions()))->select('id, amount, trx, status, type, description, date')->where('user', $id)->orderBy('id', 'DESC')->findAll();
            $data['data'] = $users;
            //dd($data);
            echo json_encode($data);
        } else {
            echo json_encode($this->request->getPost(''));
        }

    }
    public function ginv()
    {

        $id = $this->request->getPost('id');
        //dd($id);

        if ($this->request->getPost('id')) {
            $users = ((new \App\Models\Investments()))->select('id, plan, amount, return, total, status, created_at, end_time')->where('user', $id)->orderBy('id', 'DESC')->findAll();
            $data['data'] = $users;
            //dd($data);
            echo json_encode($data);
        } else {
            echo json_encode($this->request->getPost(''));
        }

    }

    public function secure_random_string($length)
    {
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }
        return strtoupper($random_string);
    }

}
