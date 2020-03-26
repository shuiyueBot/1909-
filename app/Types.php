<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table='types';
    protected $primaryKey = 'types_id';
    protected $guarded = [];
    public $timestamps = false;
}
