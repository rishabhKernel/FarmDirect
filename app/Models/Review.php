<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'reviewer_id', 'reviewee_id', 'rating', 'comment'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
