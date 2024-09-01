<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'user_roles';

    protected $fillable = [
        'role_name'
    ];

    public function user() {
        return $this->hasMany(User::class, 'role');
    }
}
