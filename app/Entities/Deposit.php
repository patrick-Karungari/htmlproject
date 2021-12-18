<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Entities;

use App\Models\Users;

class Deposit extends \CodeIgniter\Entity
{
    protected $dates = [
        'date',
    ];
    public function getUser()
    {
        $_q = (new Users())->select('id, username, first_name, last_name, phone, account, registration, email')->where('id', $this->attributes['user'])->find();

        return $_q[0];
    }
}
