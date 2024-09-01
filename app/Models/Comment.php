<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'comments';

    protected $fillable = [
        'post_id',
        'commented_by',
        'content',
        'commented_at'
    ];
}
