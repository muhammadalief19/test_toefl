<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;


class Synonym extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'synonym_lists';
    protected $fillable = [
        'Word','Synonyms'
    ];

    use HasFactory;


    
}
