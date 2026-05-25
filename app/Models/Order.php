<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'order_number',
        'farmer_id',
        'buyer_id',
        'items', // Array of items: [['crop_id' => id, 'name' => name, 'quantity' => q, 'price' => p, 'unit' => u], ...]
        'total_price',
        'status', // pending, processing, in_transit, delivered, cancelled
        'payment_status', // unpaid, paid
        'tracking_number',
        'delivery_date',
    ];

    protected $casts = [
        'items' => 'array',
        'total_price' => 'float',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
