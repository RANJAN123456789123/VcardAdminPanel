<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vcardAddModel extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'vcard_id',
        'userid',
        'nfc_id',
        'preview_url',
        'vcard_status',
        'table_status',
        'qr_code'
    ];

    public function vcardTemplateModel()
    {
        return $this->belongsTo(vCard_templateModel::class, 'vcard_id', 'id');
    }

    public function usermodel()
    {
        return $this->belongsTo(userModel::class, 'userid', 'id');
    }
}
