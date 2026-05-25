<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class Logistics extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'logistics';

    protected $fillable = [
        'farmer_id',
        'buyer_id',
        'order_id',
        'crop_id',
        'crop_name',
        'quantity',
        'unit',
        'buyer_name',
        'farmer_name',
        'status', // Order Placed, Dispatched, In Transit, Out for Delivery, Delivered
        'provider',
        'tracking_number',
        'eta',
        'pickup_address',
        'delivery_address',
        'delivery_otp',
        'otp_verified',
        'history',
    ];

    protected $casts = [
        'otp_verified' => 'boolean',
        'history' => 'array',
    ];

    public static function statusIcon($status): string
    {
        return match($status) {
            'Pending Pickup'   => 'pending',
            'Dispatched'       => 'local_shipping',
            'In Transit'       => 'move_down',
            'Out for Delivery' => 'delivery_dining',
            'Delivered'        => 'check_circle',
            default            => 'help',
        };
    }

    public static function statusColor($status): string
    {
        return match($status) {
            'Pending Pickup'   => 'amber',
            'Dispatched'       => 'blue',
            'In Transit'       => 'purple',
            'Out for Delivery' => 'indigo',
            'Delivered'        => 'green',
            default            => 'stone',
        };
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class, 'crop_id');
    }
}
