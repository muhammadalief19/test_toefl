<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
