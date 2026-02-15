<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',        // Naya column
        'location',    // Naya column
        'category',    // Naya column
        'host_name',   // Naya column
        'organizer',   // Naya column
        'guests',      // Naya column
        'price',
        'slug',
        'image'
    ];
}
