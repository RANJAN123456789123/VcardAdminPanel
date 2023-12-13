<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\permisionModel;
use Illuminate\Support\Facades\View;

class PermissionAdminCreateButtonService extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $modulePermissions = config('module_permissions');
            $buttons = [];
            $permissionModel = new permisionModel();
            foreach ($modulePermissions as $module => $permissions) {
                $moduleButtons = [];

                foreach ($permissions as $permission) {
                    $button = $permissionModel->where('module_feature_name', $module)
                        ->where('permission_name', $permission)
                        ->where('permission_status', 'active')
                        ->first();

                    $moduleButtons[$permission] = $button ? true : false;
                }

                $buttons[$module] = $moduleButtons;
            }

            $view->with('buttons', $buttons);
        });
    }
}
