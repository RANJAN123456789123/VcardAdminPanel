<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\userModel;
use Illuminate\Http\Response;

class RouteAccessAuthorizedMiddleware
{
    public function handle($request, Closure $next)
    {
        $sessionUserId = Session::get('userId');
        if (!$sessionUserId) {
            return response('Unauthorized', 401);
        }

        $userData = userModel::with('roleModel')->where('id', $sessionUserId)->first();

        // if ($userData->roleModel->permission_show !== 'active') {
        //     return response('Unauthorized', 401);
        // }

        // if ($userData->roleModel->permission_create !== 'active') {
        //     return response('Unauthorized', 401);
        // }

        if ($request->route()->getName() === 'editUser' && $userData->roleModel->user_edit !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'user' && $userData->roleModel->user_show !== 'active') {
            return response('Unauthorized', 401);
        }
        if ($request->route()->getName() === 'adduser' && $userData->roleModel->user_create !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'vcard' && $userData->roleModel->vcard_show !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'vcardTemplate' && $userData->roleModel->vcardtemplate_show !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'addRole' && $userData->roleModel->role_create !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'role' && $userData->roleModel->role_show !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'addPermission' && $userData->roleModel->permission_create !== 'active') {
            return response('Unauthorized', 401);
        }

        if ($request->route()->getName() === 'permission' && $userData->roleModel->permission_show !== 'active') {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
