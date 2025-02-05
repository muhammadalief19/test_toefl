<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class PacketClaim extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'packet_claims';

    protected $fillable = ['user_id', 'packet_id', 'time_start', 'is_completed'];
}
