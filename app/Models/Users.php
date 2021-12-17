<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Users extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = '\App\Entities\User';

    protected $allowedFields = ['username', 'email', 'phone', 'account', 'registration', 'referred_by', 'first_name', 'last_name', 'avatar'];
}