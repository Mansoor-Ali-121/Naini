<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table ='menus';
    protected $fillable = [
    
    'name', 
    'description',
    'price',
    'menu_picture',
    'category_id',
    'subcategory_id',
    'actual_slug',
    
 ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class, 'subcategory_id');
    }
}
