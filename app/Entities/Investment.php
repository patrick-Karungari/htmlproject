<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
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
