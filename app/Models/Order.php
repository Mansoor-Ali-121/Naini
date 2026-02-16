<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_status',
        'stripe_id',
        'address'
    ];

    // Relationship: Ek Order ke boht saare Items hote hain
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship: Order kis User ka hai
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}