<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreMiniTest extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = 'score_mini_tests';

    protected $fillable = [
        'user_id', 'packet_id', 'akurasi',
    ];
}
