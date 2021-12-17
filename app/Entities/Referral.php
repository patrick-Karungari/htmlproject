<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Entities;


use App\Models\Users;

class Referral extends \CodeIgniter\Entity
{
    protected $dates = ['date'];
    public function getUser()
    {
        return (new Users())->find($this->attributes['user']);
    }

    public function getRef()
    {
        return (new Users())->find($this->attributes['ref']);
    }
}