<?php

namespace App\Providers;

use App\Policies\RolePolicy;
use App\Models\userModel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        userModel::class => RolePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin_create', function (userModel $user) {
            return $user->rolemodel->admin_create === 'active';
        });

        Gate::define('admin_edit', function (userModel $user) {
            return $user->rolemodel->admin_edit === 'active';
        });
    }
}
