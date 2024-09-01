<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'configurations';

    protected $fillable = [
        'config_name',
        'config_value'
    ];
}
