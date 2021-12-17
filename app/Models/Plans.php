<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Plans extends \CodeIgniter\Model
{
    protected $table = 'plans';
    protected $returnType = '\App\Entities\Plan';

    protected $allowedFields = ['title', 'returns', 'active', 'description', 'days'];
}