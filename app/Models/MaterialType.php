<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'material_types';

    protected $fillable = [
        'type_name'
    ];
}
