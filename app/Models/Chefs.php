<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chefs extends Model
{
    protected $fillable = [
        
    'name', 
    'experience', 
    'chef_picture',
    'specialty',
    'address',
    'phone',
   
];
}
