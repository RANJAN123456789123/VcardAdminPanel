<?php

namespace App\Helpers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class AllButtonAccessHelper
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    private function getUserData($userId)
    {
        return $this->userModel->with('rolemodel')->find($userId);
    }

    private function checkPermission($userdata, $permission)
    {
        return optional($userdata->rolemodel)->{$permission} ?? 'Unauthorized';
    }

    public function checkPermissionForAction(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("admin_$action"));
    }

    public function checkPermissionForActionUser(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("user_$action"));
    }

    public function checkPermissionForActionRole(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("role_$action"));
    }

    public function checkPermissionForActionPermission(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("permission_$action"));
    }

    public function checkPermissionForActionVcard(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("vcard_$action"));
    }

    public function checkPermissionForActionVcardTemp(Request $request, $action)
    {
        $userId = $request->session()->get('userId');
        $userData = $this->getUserData($userId);
        return $this->checkPermission($userData, strtolower("vcardtemplate_$action"));
    }
}
