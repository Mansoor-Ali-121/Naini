<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $fillable = [

        'name',
        'Actual_Slug',
        'cat_id',
        'status'

    ];
    // app/Models/SubCategories.php

    public function category()
    {
        // Aapki migration mein foreign key 'cat_id' hai
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function menus()
{
    // Relationship: One-to-Many
    // Aik SubCategory, many Menu items
    return $this->hasMany(Menu::class, 'subcategory_id'); 
}
}
