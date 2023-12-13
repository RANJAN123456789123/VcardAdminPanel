<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $fillable = [
        'role_name',
        'admin_create',
        'admin_edit',
        'admin_show',
        'admin_delete',
        'user_create',
        'user_edit',
        'user_show',
        'user_delete',
        'permission_create',
        'permission_edit',
        'permission_show',
        'permission_delete',
        'role_create',
        'role_edit',
        'role_show',
        'role_delete',
        'role_status',
        'vcard_create',
        'vcard_edit',
        'vcard_show',
        'vcard_delete',
        'vcardtemplate_create',
        'vcardtemplate_edit',
        'vcardtemplate_show',
        'vcardtemplate_delete',
        'table_status',
    ];

    public function usermodel()
    {
        return $this->hasMany(userModel::class);
    }
}
