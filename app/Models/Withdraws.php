<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Withdraws extends \CodeIgniter\Model
{
    protected $table = 'withdraws';
    protected $returnType = '\App\Entities\Withdraw';

    protected $allowedFields = [
        'user', 'amount', 'phone', 'trx_id', 'status', 'description'
    ];
}