<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'activity_logs';

    protected $fillable = [
        'user_id',
        'activity_type',
        'activity_date',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
