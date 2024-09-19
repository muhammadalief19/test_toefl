<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'materials';

    protected $fillable = [
        'module_id',
        'type_id',
        'title',
        'description',
        'file_path',
        'duration',
        'created_at'
    ];

    public function type() {
        return $this->belongsTo(MaterialType::class, 'type_id', '_id');
    }

    public function module() {
        return $this->belongsTo(Module::class, 'module_id', '_id');
    }
}
