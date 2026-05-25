<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class LoanApplication extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'loan_applications';

    protected $fillable = [
        'user_id',
        'amount',
        'purpose',
        'status', // Pending, Approved, Rejected
        'applied_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
