<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Entities;


use App\Models\Plans;
use App\Models\Users;

class Investment extends \CodeIgniter\Entity
{
    public function getPlan()
    {
        return (new Plans())->find($this->attributes['plan']);
    }

    public function getUser()
    {
        return (new Users())->find($this->attributes['user']);
    }
}