<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Bid extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bids';

    protected $fillable = [
        'crop_id',
        'buyer_id',
        'amount',
        'status',
        'message',
        'counter_amount'
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
