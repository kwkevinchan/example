<?php

namespace App\Entites;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'gender', 
        'birthday', 
        'comment',
    ];

    public $timestamps = false;
}
