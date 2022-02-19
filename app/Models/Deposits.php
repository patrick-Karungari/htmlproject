<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Deposits extends \CodeIgniter\Model
{
    protected $table = 'deposits';
    protected $returnType = '\App\Entities\Deposit';

    protected $allowedFields = [
        'user', 'trx_id', 'phone', 'amount', 'status', 'description',
    ];
}
