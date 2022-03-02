<?php

namespace App\Models;

class BitcoinTrx extends \CodeIgniter\Model
{
    protected $table = 'bitcoin_trx';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sender', 'recipient', 'amount', 'status'];
    protected $returnType = '\App\Entities\BitcoinTrx';
}