<?php

namespace App\Models;

class BtcAddress extends \CodeIgniter\Model
{
    protected $table = 'btc_addresses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'address', 'user'];
    protected $returnType = 'object';
}