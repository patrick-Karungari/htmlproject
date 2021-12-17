<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Filters;


use App\Libraries\Auth;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoggedInFilter implements FilterInterface
{
    /**
     * @var Auth
     */
    private $ionAuth;
    private $session;

    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();
        $this->ionAuth = new Auth();
        if(!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('message', "Please login to continue");
            return redirect()->to(site_url('auth'));
        }
        return true;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}