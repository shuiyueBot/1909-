<?php

namespace App\index;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    protected $primaryKey = 'user_id';
    protected $guarded = [];
    public $timestamps = false;
}
