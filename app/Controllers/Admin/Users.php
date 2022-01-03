<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
namespace App\Controllers\Admin;


use App\Libraries\Flutterwave\Library\RaveEventHandlerInterface;
use App\Libraries\Flutterwave\Library\Rave;



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
    public function edit($id)
    {
        
        $user = (new \App\Models\Users())->Where('username', $id)->find();
        //dd($user);
        $user = $user[0];

        if (!$user) {
            return redirect()->back()->with('error', "User does not exist");
        }

        $this->data['site_title'] = $user->name;
        $this->data['user'] = $user;
        //return $this->_renderPage('Users/view2', $this->data);

        return $this->_renderPage('Users/edit', $this->data);

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

    public function processPayment(){
                
        $URL = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $getData = $_GET;
        $postData = $_POST;
        $publicKey = 'FLWPUBK_TEST-998b39bab3833c83deb26da4d57a18ae-X';
        $secretKey = 'FLWSECK_TEST-772b80d390e812708df81d593e11fbed-X';
        if (isset($_POST) && isset($postData['successurl']) && isset($postData['failureurl'])) {
            $success_url = $postData['successurl'];
            $failure_url = $postData['failureurl'];
        }

        $env = 'env';

        if (isset($postData['amount'])) {
            $_SESSION['publicKey'] = $publicKey;
            $_SESSION['secretKey'] = $secretKey;
            $_SESSION['env'] = $env;
            $_SESSION['successurl'] = $success_url;
            $_SESSION['failureurl'] = $failure_url;
            $_SESSION['currency'] = $postData['currency'];
            $_SESSION['amount'] = $postData['amount'];
        }

        $prefix = 'RV'; // Change this to the name of your business or app
        $overrideRef = false;

        // Uncomment here to enforce the useage of your own ref else a ref will be generated for you automatically
        if (isset($postData['ref'])) {
            $prefix = $postData['ref'];
            $overrideRef = true;
        }

        $payment = new Rave($_SESSION['secretKey'], $prefix, $overrideRef);
        if (isset($postData['amount'])) {
            // Make payment
            $payment
                ->eventHandler( new myEventHandler)
                ->setAmount($postData['amount'])
                ->setPaymentOptions($postData['payment_options']) // value can be card, account or both
                ->setDescription($postData['description'])
                ->setLogo($postData['logo'])
                ->setTitle($postData['title'])
                ->setCountry($postData['country'])
                ->setCurrency($postData['currency'])
                ->setEmail($postData['email'])
                ->setFirstname($postData['firstname'])
                ->setLastname($postData['lastname'])
                ->setPhoneNumber($postData['phonenumber'])
                ->setPayButtonText($postData['pay_button_text'])
                ->setRedirectUrl($URL)
                // ->setMetaData(array('metaname' => 'SomeDataName', 'metavalue' => 'SomeValue')) // can be called multiple times. Uncomment this to add meta datas
                // ->setMetaData(array('metaname' => 'SomeOtherDataName', 'metavalue' => 'SomeOtherValue')) // can be called multiple times. Uncomment this to add meta datas
                ->initialize();
        } else {
            if (isset($getData['cancelled'])) {
                // Handle canceled payments
                $payment
                    ->eventHandler(new myEventHandler)
                    ->paymentCanceled($getData['cancelled']);
            } elseif (isset($getData['tx_ref'])) {
                // Handle completed payments
                $payment->logger->notice('Payment completed. Now requerying payment.');
                $payment
                    ->eventHandler(new myEventHandler)
                    ->requeryTransaction($getData['transaction_id']);
            } else {
                $payment->logger->warn('Stop!!! Please pass the txref parameter!');
                echo 'Stop!!! Please pass the txref parameter!';
            }
        }



    }
    function getURL($url, $data = array())
    {
        $urlArr = explode('?', $url);
        $params = array_merge($_GET, $data);
        $new_query_string = http_build_query($params) . '&' . $urlArr[1];
        $newUrl = $urlArr[0] . '?' . $new_query_string;
        return $newUrl;
    }
}


class myEventHandler implements raveEventHandlerInterface
{
    /**
     * This is called when the Rave class is initialized
     * */
    public function onInit($initializationData)
    {
        // Save the transaction to your DB.
    }

    /**
     * This is called only when a transaction is successful
     * */
    public function onSuccessful($transactionData)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Comfirm that the transaction is successful
        // Confirm that the chargecode is 00 or 0
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here
        if ($transactionData->status === 'successful') {
            if ($transactionData->currency == $_SESSION['currency'] && $transactionData->amount == $_SESSION['amount']) {

                if ($_SESSION['publicKey']) {
                    header('Location: ' . getURL($_SESSION['successurl'], array('event' => 'successful')));
                    $_SESSION = array();
                    session_destroy();
                }
            } else {
                if ($_SESSION['publicKey']) {
                    header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'suspicious')));
                    $_SESSION = array();
                    session_destroy();
                }
            }
        } else {
            $this->onFailure($transactionData);
        }
    }

    /**
     * This is called only when a transaction failed
     * */
    public function onFailure($transactionData)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
        // You can also redirect to your failure page from here
        if ($_SESSION['publicKey']) {
            header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'failed')));
            $_SESSION = array();
            session_destroy();
        }
    }

    /**
     * This is called when a transaction is requeryed from the payment gateway
     * */
    public function onRequery($transactionReference)
    {
        // Do something, anything!
    }

    /**
     * This is called a transaction requery returns with an error
     * */
    public function onRequeryError($requeryResponse)
    {
        echo 'the transaction was not found';
    }

    /**
     * This is called when a transaction is canceled by the user
     * */
    public function onCancel($transactionReference)
    {
        // Do something, anything!
        // Note: Somethings a payment can be successful, before a user clicks the cancel button so proceed with caution
        if ($_SESSION['publicKey']) {
            header('Location:'. getURL($_SESSION['failureurl'], array('event' => 'canceled')));
            $_SESSION = array();
            session_destroy();
        }
    }

    /**
     * This is called when a transaction doesn't return with a success or a failure response. This can be a timedout transaction on the Rave server or an abandoned transaction by the customer.
     * */
    public function onTimeout($transactionReference, $data)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Queue it for requery. Preferably using a queue system. The requery should be about 15 minutes after.
        // Ask the customer to contact your support and you should escalate this issue to the flutterwave support team. Send this as an email and as a notification on the page. just incase the page timesout or disconnects
        if ($_SESSION['publicKey']) {
            header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'timedout')));
            $_SESSION = array();
            session_destroy();
        }
    }
  

}
