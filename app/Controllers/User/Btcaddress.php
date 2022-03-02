<?php

namespace app\Controllers\User;

class Btcaddress extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "BTC Addresses";
    }

    public function index()
    {

    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->request->getPost()) {
            $model = new \App\Models\BtcAddress();
            try {
                $model->save([
                    'label' => trim($this->request->getPost('name')),
                    'address' => trim($this->request->getPost('address')),
                    'user'      => $this->current_user->id,
                ]);
                return redirect()->back()->with('success', "Address saved successfully");
            } catch (\ReflectionException $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->back()->with('error', "Invalid request");
    }
}