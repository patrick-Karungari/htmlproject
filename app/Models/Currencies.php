<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Currencies extends \CodeIgniter\Model
{
    protected $table = 'currency';
    protected $returnType = '\App\Entities\Currency';

    protected $allowedFields = ['currency', 'buying', 'selling'];
}
