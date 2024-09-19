<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'topics';

    protected $fillable = [
        'forum_id',
        'topic_title',
        'created_by',
        'created_at'
    ];

    public function forum() {
        return $this->belongsTo(Forum::class, 'forum_id', '_id');
    }

    public function post() {
        return $this->hasMany(Post::class, 'topic_id', '_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', '_id');
    }
}
