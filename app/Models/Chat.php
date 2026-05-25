<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'participants', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
}
