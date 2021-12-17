<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Transactions extends \CodeIgniter\Model
{
    protected $table = 'transactions';
    protected $allowedFields = [
        'user', 'amount', 'type', 'description', 'status'
    ];
    protected $returnType = 'object';
}