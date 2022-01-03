<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Libraries;

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailer.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'SMTP.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'Exception.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    /**
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    public $mail;
    /**
     * @var string
     */
    public $error;

    public function __construct()
    {
        $this->mail = new PHPMailer();

        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return z;
        }
    }

    public function sendMessage($recipient, $subject, $message): bool
    {
        try {
            $this->mail->setFrom(get_option('mailer_email_from', 'admin@admin.com'), get_option('mailer_email_from_name', get_option('site_title', 'admin')));
            if (is_array($recipient)) {
                foreach ($recipient as $item) {
                    $this->mail->addAddress(trim($item));
                }
            } else {
                $this->mail->addAddress($recipient);
            }
            $delivery_method = get_option('mailer_delivery_method', 'dummy');
            if ($delivery_method == 'smtp') {
                $this->mail->isSMTP();

                if (get_option('mailer_authentication') == 'yes') {
                    $this->mail->SMTPAuth = true;
                    $this->mail->Username = get_option('mailer_smtp_username');
                    $this->mail->Password = get_option('mailer_smtp_password');
                }
                $this->mail->Host = get_option('mailer_smtp_host');
                $this->mail->Port = get_option('mailer_smtp_port');
                $security = get_option('mailer_smtp_security');
                if ($security == 'none') {
                    $this->mail->SMTPSecure = false;
                } elseif ($security == 'ssl') {
                    $this->mail->SMTPSecure = 'ssl';
                } else {
                    $this->mail->SMTPSecure = 'tls';
                }
                $this->mail->SMTPAutoTLS = false;

                if (get_option('mailer_smtp_verify_certs') == 'no') {
                    $this->mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ),
                    );
                } else {
                    $this->mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => true,
                            'verify_peer_name' => true,
                            'allow_self_signed' => true,
                        ),
                    );
                }

            } else {
                $this->mail->isMail();
            }

            //$this->mail->setFrom('no-reply@nyambariaschoolalumni.org', get_option('site_title', __l('my_website')));            $this->mail->addAddress($recipient);
            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->AltBody = strip_tags($message);

            if ($this->mail->send()) {
                return true;
            }

            //dd($this->mail->ErrorInfo);
        } catch (Exception | \Exception $e) {
            $this->error = $e->getMessage();
        }

        return false;
    }
}
