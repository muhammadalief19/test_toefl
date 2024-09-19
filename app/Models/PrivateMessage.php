<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class PrivateMessage extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'private_messages';

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'message_content',
        'sent_at'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', '_id');
    }

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id', '_id');
    }
}
