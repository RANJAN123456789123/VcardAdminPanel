<?php

namespace App\Policies;

use App\Models\userModel;
use App\Models\roleModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function view(userModel $user, roleModel $role)
    {
        return $user->role_id == $role->id;
    }

    public function admin_create(userModel $user)
    {

        return $user->rolemodel->admin_create === 'active';
    }

    public function admin_edit(userModel $user)
    {
        return $user->rolemodel->admin_edit === 'active';
    }
}
