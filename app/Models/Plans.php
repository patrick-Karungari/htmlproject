<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Plans extends \CodeIgniter\Model
{
    protected $table = 'plans';
    protected $returnType = '\App\Entities\Plan';

    protected $allowedFields = ['title', 'returns', 'active', 'description', 'days'];
}
