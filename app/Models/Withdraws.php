<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Withdraws extends \CodeIgniter\Model
{
    protected $table = 'withdraws';
    protected $returnType = '\App\Entities\Withdraw';

    protected $allowedFields = [
        'user', 'amount', 'phone', 'trx_id', 'status', 'description',
    ];
}
