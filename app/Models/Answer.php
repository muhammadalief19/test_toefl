<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Answer extends Model
{
    protected $collection = 'answers';
    protected $connection = 'mongodb';
    protected $fillable = [
        'user_id', 'packet_id', 'score', 'user_answers'
    ];

    public function answers()
    {
        return $this->belongsTo(Paket::class, 'packet_id', 'packet_id');
    }

    use HasFactory;
}
