<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class UserRole extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user_roles';

    protected $fillable = [
        'role_name'
    ];
    use HasFactory;


    public function user() {
        return $this->hasMany(User::class, 'role');
    }
}
