<?php

namespace App\Models;

class Notifications extends \CodeIgniter\Model
{
    protected $primaryKey = 'id';
    protected $allowedFields = ['user', 'notification', 'time', 'title', 'read'];
    protected $returnType = 'object';
    protected $table = 'notifications';
}