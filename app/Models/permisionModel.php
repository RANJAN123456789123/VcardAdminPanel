<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisionModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $fillable = [
        '_id',
        'module_feature_name',
        'permission_name',
        'created_at',
        'updated_at',
        'permission_status'

    ];
}
