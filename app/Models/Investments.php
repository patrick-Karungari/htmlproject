<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Investments extends \CodeIgniter\Model
{
    protected $table = 'investments';
    protected $allowedFields = [
        'user', 'plan', 'amount', 'return', 'total', 'status', 'start_time', 'end_time',
    ];
    protected $returnType = '\App\Entities\Investment';
}
