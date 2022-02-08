<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Bitcoins extends \CodeIgniter\Model
{
    protected $table = 'bitcoin_bal';
    protected $returnType = '\App\Entities\Bitcoin';

    protected $allowedFields = ['user', 'balance'];
}
