<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'payment_method',
        'payment_date',
        'transaction_status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', '_id');
    }
}
