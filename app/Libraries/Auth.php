<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */


namespace App\Libraries;

use App\Models\Users;

/**
 * Name:    Ion Auth
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.
 *               This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP7.2 or above
 *
 * @package    CodeIgniter-Ion-Auth
 * @author     Ben Edmunds <ben.edmunds@gmail.com>
 * @author     Phil Sturgeon
 * @author     Benoit VRIGNAUD <benoit.vrignaud@zaclys.net>
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       http://github.com/benedmunds/CodeIgniter-Ion-Auth
 * @filesource
 */

/**
 * This class is the Auth library.
 */
class Auth
{
	/**
	 * Configuration
	 *
	 * @var \Config\Auth
	 */
	protected $config;

	/**
	 * Auth model
	 *
	 * @var \App\Models\AuthModel
	 */
	protected $authModel;

	/**
	 * Email class
	 *
	 * @var \App\Libraries\Mailer
	 */
	protected $email;
	protected $Udata;
	/**
	 * __construct
	 *
	 * @author Ben
	 */
	public function __construct()
	{
		// Check compat first
		$this->checkCompatibility();

		$this->config = config('Auth');

		$this->email = new \App\Libraries\Mailer();
		helper('cookie');

		$this->session = session();

		$this->authModel = new \App\Models\AuthModel();


		$this->authModel->triggerEvents('library_constructor');
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 * @param string $method    Method to call
	 * @param array  $arguments Method arguments
	 *
	 * @return mixed
	 * @throws \Exception When $method is undefined.
	 */
	public function __call(string $method, array $arguments)
	{
		if (! method_exists( $this->authModel, $method))
		{
			throw new \Exception('Undefined method Auth::' . $method . '() called');
		}
		if ($method === 'create_user')
		{
			return call_user_func_array([$this, 'register'], $arguments);
		}
		if ($method === 'update_user')
		{
			return call_user_func_array([$this, 'update'], $arguments);
		}
		return call_user_func_array([$this->authModel, $method], $arguments);
	}

	/**
	 * Forgotten password feature
	 *
	 * @param string $identity Identity
	 *
	 * @return array|boolean
	 * @author Mathew
	 */
	public function forgottenPassword(string $identity)
	{
		// Retrieve user information
		$user = (new Users())->where('email', $identity)
					 ->orWhere('username', $identity)
					 ->where('active', 1)
					 ->get()->getFirstRow($this->config->userReturnType);

		if ($user)
		{
			// Generate code
			$code = $this->authModel->forgottenPassword($identity);
			$adminEmail = $this->config->adminEmail;

			if ($code)
			{
				$data = [
					'identity'              => $identity,
					'forgottenPasswordCode' => $code,
					'supportEmail' => $adminEmail
				];

				if ($this->email) {
                    //$message = view($this->config->emailTemplates . $this->config->emailForgotPassword, $data);
                    $message = view('Auth/email/forgot_password.tpl.php', $data);
                    try {
//                        $this->email->mail->clearAddresses();
//                        $this->email->mail->setFrom($this->config->adminEmail, $this->config->siteTitle);
//                        $this->email->mail->addAddress($user->email);
                        $subject = "Reset Password - Ken Coin";
//                        $this->email->mail->Subject = $subject;
//                        $this->email->mail->Body = $message;
//                        $this->email->mail->AltBody = strip_tags($message);
                        //if ($this->email->mail->send())
                        if ($this->email->sendMessage($user->email, $subject, $message))
                        {
                            $this->setMessage('Auth.forgot_password_successful');
                            return true;
                        }
                    } catch (\Exception $e) {

                        $this->setError($e->getMessage());

                        return false;
                    }
                }

			}
		}

		$this->setError('Auth.forgot_password_unsuccessful');
		return false;
	}

	/**
	 * Forgotten password check
	 *
	 * @param string $code Code
	 *
	 * @return object|boolean
	 * @author Michael
	 */
	public function forgottenPasswordCheck(string $code)
	{
		$user = $this->authModel->getUserByForgottenPasswordCode($code);

		if (! is_object($user))
		{
			$this->setError('Auth.password_change_unsuccessful');
			return false;
		}
		else
		{
			if ($this->config->forgotPasswordExpiration > 0)
			{
				//Make sure it isn't expired
				$expiration = $this->config->forgotPasswordExpiration;
				if (time() - $user->forgotten_password_time > $expiration)
				{
					//it has expired
					$identity = $user->{$this->config->identity};
					$this->authModel->clearForgottenPasswordCode($identity);
					$this->setError('Auth.password_change_unsuccessful');
					return false;
				}
			}
			return $user;
		}
	}

	/**
	 * Register
	 *
	 * @param string $identity       Identity
	 * @param string $password       Password
	 * @param string $email          Email
	 * @param array  $additionalData Additional data
	 * @param array  $groupIds       Groups id
	 *
	 * @return integer|array|boolean The new user's ID if e-mail activation is disabled or Ion-Auth e-mail activation
	 *                               was completed;
	 *                               or an array of activation details if CI e-mail validation is enabled; or false
	 *                               if the operation failed.
	 * @author Mathew
	 */
	public function register(string $identity, string $password, string $email, array $additionalData = [], array $groupIds = [])
	{
		$this->authModel->triggerEvents('pre_account_creation');

		$emailActivation = $this->config->emailActivation;
		$adminEmail = $this->config->adminEmail;

		$id = $this->authModel->register($identity, $password, $email, $additionalData, $groupIds);

		if (! $emailActivation)
		{
			if ($id !== false)
			{
				$this->setMessage('Auth.account_creation_successful');
				$this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_successful']);
				return $id;
			}
			else
			{
				$this->setError('Auth.account_creation_unsuccessful');
				$this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_unsuccessful']);
				return false;
			}
		}
		else
		{
			if (! $id)
			{
				$this->setError('Auth.account_creation_unsuccessful');
				return false;
			}

			// deactivate so the user must follow the activation flow
			$deactivate = $this->authModel->deactivate($id, null);

			// the deactivate method call adds a message, here we need to clear that
			$this->authModel->clearMessages();

			if (! $deactivate)
			{
				$this->setError('Auth.deactivate_unsuccessful');
				$this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_unsuccessful']);
				return false;
			}

			$activationCode = $this->authModel->activationCode;
			$identity       = $this->config->identity;
			$user           = $this->authModel->user($id);

			$data2 = [
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'supportEmail' => $adminEmail,
				'name'		 => $user->first_name,
				'activation' => $activationCode,
			];

				$message = view('Auth/email/mail_verify_email.php', $data2);

                if ($this->email) {
                    //$message = view($this->config->emailTemplates . $this->config->emailForgotPassword, $data);
                    //$message = view('Auth/email/forgot_password.tpl.php', $data);
                    try {
//                        $this->email->mail->clearAddresses();
//                        $this->email->mail->setFrom($this->config->adminEmail, $this->config->siteTitle);
//                        $this->email->mail->addAddress($email);
                        $subject = $this->config->siteTitle . ' - ' . lang('Auth.emailActivation_subject');
//                        $this->email->mail->Body = $message;
//                        $this->email->mail->AltBody = strip_tags($message);
                        if ($this->email->sendMessage($email, $subject, $message))
                        {
                            $this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_successful', 'activation_email_successful']);
                            $this->setMessage('Auth.activation_email_successful');
							$data = ['user' => ['email' => $user->email, 'id' => $user->id]];
							$this->setUData($data);

                            return $id;
                        }
                    } catch (\Exception $e) {

                        $this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful']);
                        $this->setError('Auth.activation_email_unsuccessful');
                        return false;
                    }
                }

			$this->authModel->triggerEvents(['post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful']);
			$this->setError('Auth.activation_email_unsuccessful');
			return false;
		}
	}


	/***
	 * Send mail with view
	 * 
	 * */

	public function sendMail($arrayData, $e_mail): bool
	{
		if (!empty($arrayData) && !empty($e_mail)){
			$message = view('Auth/email/mail_verify_email.php', $arrayData);

			if ($this->email){
				try {
					$subject = $this->config->siteTitle . ' - ' . lang('Auth.emailActivation_subject');
					if ($this->email->sendMessage($e_mail, $subject, $message)) {
						return true;
					}

				} catch (\Exception $e) {

					return false;

				}

			}
		}
		return false;
	}	

 
	/**
	 * Logout
	 *
	 * @return true
	 * @author Mathew
	 */
	public function logout(): bool
	{
		$this->authModel->triggerEvents('logout');

		$identity = $this->session->get('user_id');
		
		$this->session->remove([$identity, 'id', 'user_id', 'identity', 'email', 'username']);

		// delete the remember me cookies if they exist
		delete_cookie($this->config->rememberCookieName);

		// Clear all codes
		if (isset($identity)) {
			$this->authModel->clearForgottenPasswordCode($identity);
			$this->authModel->clearRememberCode($identity);
		}
		
		// Destroy the session
		// $this->session->destroy();

		// Recreate the session
		// session_start();

		// session_regenerate_id(true);
        \CodeIgniter\Events\Events::trigger('logout');

		$this->setMessage('Auth.logout_successful');
		return true;
	}

	/**
	 * Auto logs-in the user if they are remembered
	 *
	 * @author Mathew
	 *
	 * @return boolean Whether the user is logged in
	 */
	public function loggedIn(): bool
	{
		$this->authModel->triggerEvents('logged_in');

		$recheck = $this->authModel->recheckSession();

		// auto-login the user if they are remembered
		if (! $recheck && get_cookie($this->config->rememberCookieName))
		{
			$recheck = $this->authModel->loginRememberedUser();
		}

		return $recheck;
	}



	/* * Get the data if any as array to be sent to login
	 * 
	 */

	public function getUData(): array 
	{
		return $this->Udata;
	}

	 
	/**
	 * Set the data if any as array to be sent to login
	 * 
	 */

	private function setUData( $data = []) 
	{
		 $this->Udata = $data;
	}
	

	/**
	 * Get user id
	 *
	 * @return integer|null The user's ID from the session user data or NULL if not found
	 * @author jrmadsen67
	 **/
	public function getUserId()
	{
		$userId = $this->session->get('user_id');
		if (! empty($userId))
		{
			return $userId;
		}
		return null;
	}

	/**
	 * Check to see if the currently logged in user is an admin.
	 *
	 * @param integer $id User id
	 *
	 * @return boolean Whether the user is an administrator
	 * @author Ben Edmunds
	 */
	public function isAdmin(int $id=0): bool
	{
		$this->authModel->triggerEvents('is_admin');

		$adminGroup = $this->config->adminGroup;

		return $this->loggedIn() && $this->authModel->inGroup($adminGroup, $id);
	}



	/**
	 * Check the compatibility with the server
	 *
	 * Script will die in case of error
	 *
	 * @return void
	 */
	protected function checkCompatibility()
	{
		// I think we can remove this method

		/*
		// PHP password_* function sanity check
		if (!function_exists('password_hash') || !function_exists('password_verify'))
		{
			show_error("PHP function password_hash or password_verify not found. " .
				"Are you using CI 2 and PHP < 5.5? " .
				"Please upgrade to CI 3, or PHP >= 5.5 " .
				"or use password_compat (https://github.com/ircmaxell/password_compat).");
		}
		*/

		/*
		// Compatibility check for CSPRNG
		// See functions used in Ion_auth_model::randomToken()
		if (!function_exists('random_bytes') && !function_exists('mcrypt_create_iv') && !function_exists('openssl_random_pseudo_bytes'))
		{
			show_error("No CSPRNG functions to generate random enough token. " .
				"Please update to PHP 7 or use random_compat (https://github.com/paragonie/random_compat).");
		}
		*/
	}

}
