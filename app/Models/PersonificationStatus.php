<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonificationStatus extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
