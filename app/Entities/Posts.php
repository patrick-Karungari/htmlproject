<?php


namespace App\Entities;



class Posts extends \CodeIgniter\Entity
{
    public function getUser()
    {
        return (new Posts())->find($this->attributes['user']);
    }
}