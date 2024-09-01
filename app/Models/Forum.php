<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'forums';

    protected $fillable = [
        'forum_name',
        'description'
    ];

    public function topic() {
        return $this->hasMany(Topic::class, 'topic_id', '_id');
    }
}
