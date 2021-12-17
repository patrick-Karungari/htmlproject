<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Referrals extends \CodeIgniter\Model
{
    protected $table = 'referrals';
    protected $allowedFields = ['user', 'ref', 'first_amount', 'bonus', 'status'];
    protected $returnType = '\App\Entities\Referral';
}