<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Models;

class Posts extends \CodeIgniter\Model
{
    protected $table = 'posts';
    protected $returnType = '\App\Entities\Posts';

    protected $allowedFields = ['user', 'created_at', 'txt', 'title', 'slug'];
}
