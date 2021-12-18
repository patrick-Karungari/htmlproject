<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Transactions extends \CodeIgniter\Model
{
    protected $table = 'transactions';
    protected $allowedFields = [
        'user', 'amount', 'type', 'description', 'status',
    ];
    protected $returnType = 'object';
}
