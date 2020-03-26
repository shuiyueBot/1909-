<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    protected $table='plot';
    protected $primaryKey = 'pid';
    protected $guarded = [];
    public $timestamps = false;
}
