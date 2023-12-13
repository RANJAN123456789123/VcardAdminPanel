<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Helpers\AllButtonAccessHelper;
use App\Models\UserModel;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('AllButtonAccessHelper', function ($app) {
            return new AllButtonAccessHelper($app->make(UserModel::class));
        });
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $allButtonAccessHelper = app('AllButtonAccessHelper');
            $request = request();
            $view->with('allButtonAccessHelper', $allButtonAccessHelper)
                ->with('request', $request);
        });
    }
}
