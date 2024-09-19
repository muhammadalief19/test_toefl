<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'posts';

    protected $fillable = [
        'topic_id',
        'posted_by',
        'content',
        'posted_at'
    ];

    public function topic() {
        return $this->belongsTo(Topic::class, 'topic_id', '_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'post_id', '_id');
    }
}
