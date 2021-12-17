<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Models;


class Posts extends \CodeIgniter\Model
{
    protected $table = 'posts';
    protected $returnType = '\App\Entities\Posts';

    protected $allowedFields = ['user', 'created_at', 'txt', 'title', 'slug'];
}