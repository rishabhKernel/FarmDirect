<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'farmer_id', 'title', 'description', 'price_per_unit', 
        'qty_available', 'unit', 'images', 'category', 'ai_price_insight'
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
