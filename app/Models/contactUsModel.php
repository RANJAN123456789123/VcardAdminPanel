<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactUsModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $fillable = [
        'name',
        'ToEmail',
        'fromEmail',
        'subject',
        'phone_number',
        'message'

    ];
}
