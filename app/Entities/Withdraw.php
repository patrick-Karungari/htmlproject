<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Entities;


use App\Models\Users;

class Withdraw extends \CodeIgniter\Entity
{
    protected $dates = [
        'date'
    ];

    public function getUser()
    {
        $_q = (new Users())->select('id, username, first_name, last_name, phone, account, registration, email')->where('id',$this->attributes['user'])->find();
       
         return $_q[0];
          
    }
}
