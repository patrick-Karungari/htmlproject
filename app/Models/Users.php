<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Users extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = '\App\Entities\User';

    protected $allowedFields = ['username', 'email', 'phone', 'account', 'registration', 'referred_by', 'first_name', 'last_name', 'avatar'];
}
