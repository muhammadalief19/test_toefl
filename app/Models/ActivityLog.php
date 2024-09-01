<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'activity_logs';

    protected $fillable = [
        'user_id',
        'acivity_type',
        'activity_date',
        'description'
    ];
}
