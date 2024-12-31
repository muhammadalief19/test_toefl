<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "targets";

    protected $fillable = [
        'name_level_target',
        'score_target',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
