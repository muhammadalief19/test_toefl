<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class TestStatus extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'test_status';

    protected $fillable = [
        'user_id',
        'packet_id',
        'status',
    ];

    public function packet()
    {
        return $this->belongsTo(Paket::class, 'packet_id', '_id');
        // 'packet_id' di TestStatus merujuk ke '_id' di Paket (karena MongoDB)
    }
}
