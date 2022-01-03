<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Referrals extends \CodeIgniter\Model
{
    protected $table = 'referrals';
    protected $allowedFields = ['user', 'ref', 'first_amount', 'bonus', 'status'];
    protected $returnType = '\App\Entities\Referral';
}
