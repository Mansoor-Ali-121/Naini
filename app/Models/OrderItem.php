<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price'
    ];

    // Relationship: Ye item kis Order ka hissa hai
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: Ye item kaunsi Dish/Menu hai
    public function menu()
    {
        return $this->belongsTo(Menu::class); // Aapke menu table ka model
    }
}