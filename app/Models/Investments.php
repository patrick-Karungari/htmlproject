<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Investments extends \CodeIgniter\Model
{
    protected $table = 'investments';
    protected $allowedFields = [
        'user', 'plan', 'amount', 'return', 'total', 'status', 'start_time', 'end_time'
    ];
    protected $returnType = '\App\Entities\Investment';
}