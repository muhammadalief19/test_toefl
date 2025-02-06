<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class TestStatus extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'test_status';

    protected $fillable = [
        'user_id',
        'packet_id',
        'status',
    ];
}
