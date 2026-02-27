<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

        'name',
        'ActualSlug',
        'description'
    ];

    public function subcategories()
    {
        // Relationship: One-to-Many
        // Aik Category, many SubCategories
        return $this->hasMany(SubCategories::class, 'cat_id');
    }
}
