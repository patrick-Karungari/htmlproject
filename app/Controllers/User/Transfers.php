<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

use App\Models\Bitcoins;
use App\Models\BitcoinTrx;
use App\Models\Users;
use CodeIgniter\Session\Session;

class Transfers extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Send Money";
    }

    public function index()
    {

        if ($this->request->getPost()) {
            $step = $this->request->getPost('step') ?? '1';
            $session = session();
            if ($step == '1') {
                $username = $this->request->getPost('username');
                $amount = $this->request->getPost('amount');
                $currency = $this->request->getPost('currency');
                $this->data['username'] = $username;
                $this->data['amount'] = $amount;
                $this->data['currency'] = $currency;

                $bitcoins = (new Bitcoins())->where('user', $this->current_user->id)->first();
                if (!$bitcoins || $bitcoins->balance < $amount) {
                    $session->remove('_transfers');
                    return redirect()->back()->with('error', "You do not have enough crypto to transfer");
                }

                //User
                $user = (new Users())->where('username', $username)->orWhere('email', $username)->first();
                if (!$user) {
                    return redirect()->back()->with('error', "Recipient not found");
                }
                $step++;
                $this->data['step'] = $step;
                $this->data['user'] = $user;

                $session->set('_transfers', $this->data);

                return redirect()->to(site_url('user/transfers/index/2'));
            } else if ($step == '2') {
                if (!$session->has('_transfers')) {
                    return redirect()->back();
                }
                //Confirmed. Complete transaction
                $myBitcoins = (new Bitcoins())->where('user', $this->current_user->id)->first();
                $temp = $session->get('_transfers');
                $amount = $temp['amount'];
                $recipient = $temp['user'];
                $theirBitcoins = (new Bitcoins())->where('user', $recipient->id)->first();
                $myBalance = $myBitcoins->balance-$amount;
                (new Bitcoins())->update($this->current_user->id, ['balance' => $myBalance]);
                if ($theirBitcoins) {
                    $theirNewBalance = $theirBitcoins->balance + $amount;
                    (new Bitcoins())->update($theirBitcoins->id, ['balance' => $theirNewBalance]);
                } else {
                    $theirNewBalance = $amount;
                    (new Bitcoins())->save(['user' => $recipient->id, 'balance' => $amount]);
                }
                user_notification($this->current_user->id, "BTC Transfer", "You have successfully transferred BTC $amount to {$recipient->username}. New balance is BTC $myBalance");
                user_notification($recipient->id, "BTC Transfer", "You have received BTC $amount from {$this->current_user->username}. New balance is BTC $theirNewBalance");
                //Create transaction
                $trxModel = new BitcoinTrx();
                $trxModel->save([
                    'sender'    => $this->current_user->id,
                    'recipient' => $recipient->id,
                    'amount'    => $amount,
                    'status'    => '1',
                    'type'      => 'btc'
                ]);

                $step++;

                $this->data['step'] = $step;
                $session->set('_transfers', $this->data);
                $session->markAsFlashdata('_transfers');
                return redirect()->to(site_url('user/transfers/index/3'));
            }
        }

        $this->data['step'] = $step ?? 1;
        return $this->_renderPage('Transfer/index', $this->data);
    }

    public function money()
    {

        if ($this->request->getPost()) {
            $step = $this->request->getPost('step') ?? '1';
            $session = session();
            if ($step == '1') {
                $username = $this->request->getPost('username');
                $amount = $this->request->getPost('amount');
                $currency = $this->request->getPost('currency');
                $this->data['username'] = $username;
                $this->data['amount'] = $amount;
                $this->data['currency'] = $currency;

                $balance = $this->current_user->account;
                if (!$balance || $balance < $amount) {
                    $session->remove('_transfers');
                    return redirect()->back()->with('error', "You do not have enough money to transfer");
                }

                //User
                $user = (new Users())->where('username', $username)->orWhere('email', $username)->first();
                if (!$user) {
                    return redirect()->back()->with('error', "Recipient not found");
                }
                $step++;
                $this->data['step'] = $step;
                $this->data['user'] = $user;

                $session->set('_transfers', $this->data);

                return redirect()->to(site_url('user/transfers/money/2'));
            } else if ($step == '2') {
                if (!$session->has('_transfers')) {
                    return redirect()->back();
                }
                //Confirmed. Complete transaction
                $balance = $this->current_user->account;
                $temp = $session->get('_transfers');
                $amount = $temp['amount'];
                $recipient = $temp['user'];
                $currency = $temp['currency'];
                $theirAccount = $recipient->account;
                $myNewBalance = $balance-$amount;
                (new Users())->update($this->current_user->id, ['account' => $myNewBalance]);

                    $theirNewBalance = $theirAccount + $amount;
                    (new Users())->update($recipient->id, ['account' => $theirNewBalance]);


                //TODO: Create transaction
                $trxModel = new BitcoinTrx();
                $trxModel->save([
                    'sender'    => $this->current_user->id,
                    'recipient' => $recipient->id,
                    'amount'    => $amount,
                    'status'    => '1',
                    'type'      => 'money'
                ]);
                $description = "You have transferred $currency $amount from your account to {$recipient->username}. New balance is $currency $myNewBalance";
                (new \App\Models\Transactions())->save([
                    'user'      => $this->current_user->id,
                    'amount'    => $amount,
                    'trx'       => strtoupper(random_string()),
                    'type'      => 'transfer',
                    'status'    => 'completed',
                    'description'   => $description
                ]);
                user_notification($this->current_user->id, "Money Transfer", $description);
                user_notification($recipient->id, "Money Received", "You have received $currency $amount from {$this->current_user->username}. New balance is $currency $theirNewBalance");
                $step++;

                $this->data['step'] = $step;
                $session->set('_transfers', $this->data);
                $session->markAsFlashdata('_transfers');
                return redirect()->to(site_url('user/transfers/money/3'));
            }
        }

        $this->data['step'] = $step ?? 1;
        return $this->_renderPage('Transfer/money', $this->data);
    }
}
