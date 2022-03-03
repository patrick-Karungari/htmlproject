<?php

namespace App\Models;

class WithdrawAccounts extends \CodeIgniter\Model
{
    protected $primaryKey = 'id';
    protected $table = 'withdraw_accounts';
    protected $allowedFields = ['user', 'method', 'name', 'account', 'verified'];
    protected $returnType = 'object';
}