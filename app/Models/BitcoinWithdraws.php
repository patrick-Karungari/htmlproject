<?php

namespace App\Models;

class BitcoinWithdraws extends \CodeIgniter\Model
{
    protected $table = 'bitcoin_withdraws';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user','address','amount','status', 'trx_id'];
    protected $returnType = '\App\Entities\BitcoinWithdraw';
}