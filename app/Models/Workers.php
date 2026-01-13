<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    protected $fillable = [
        'name',
        'picture',
        'actual_slug',
        'field',
        'address',
        'phone',
        'role',
        'status',
    ];
}
