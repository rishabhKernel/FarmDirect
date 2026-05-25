<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class MandiPrice extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'mandi_prices';

    protected $fillable = [
        'crop_name',
        'mandi_name',
        'state',
        'price_per_q',
        'category',
        'updated_at'
    ];
}
