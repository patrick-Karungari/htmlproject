<?php

namespace App\Models;

class BitcoinWithdraws extends \CodeIgniter\Model
{
    protected $table = 'bitcoin_withdraws';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user','address','amount','status'];
    protected $returnType = 'object';
}