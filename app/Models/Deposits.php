<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Deposits extends \CodeIgniter\Model
{
    protected $table = 'deposits';
    protected $returnType = '\App\Entities\Deposit';

    protected $allowedFields = [
        'user', 'trx_id', 'phone', 'amount', 'status', 'description'
    ];
}