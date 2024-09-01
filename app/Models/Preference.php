<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'preferences';

    protected $fillable = [
        'user_id',
        'notification_preference',
        'content_preference'
    ];
}
