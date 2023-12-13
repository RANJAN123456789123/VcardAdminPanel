<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vCard_templateModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_name',
        'template_photo',
        'template_url',
        'used_count',
        'Vtable_status'
    ];
    public function vcardModel()
    {
        return $this->hasMany(vcardAddModel::class);
    }
}
