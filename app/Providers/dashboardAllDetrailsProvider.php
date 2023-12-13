<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\userModel;
use App\Models\vcardAddModel;
use App\Models\vCard_templateModel;
use Illuminate\Support\Facades\View;

class dashboardAllDetrailsProvider extends ServiceProvider
{

    public function register(): void
    {
    }


    public function boot(): void
    {
        View::composer('*', function ($dashboardDetails) {
            $usermodel = new userModel();
            $getuser = $usermodel->get();
            $getusercount = count($getuser);

            $dashboardDetails->with('dashboarddetails', $getusercount);
        });

        View::composer('*', function ($vcardcountDetails) {
            $vcardAddModel = new vcardAddModel();
            $getvcard = $vcardAddModel->get();
            $getVcount = count($getvcard);

            $vcardcountDetails->with('vcardcountDetails', $getVcount);
        });

        View::composer('*', function ($tempvcardcountDetails) {
            $vCard_templateModel = new vCard_templateModel();
            $getvcardtemp = $vCard_templateModel->get();
            $getVTempcount = count($getvcardtemp);

            $tempvcardcountDetails->with('tempvcardcountDetails', $getVTempcount);
        });
    }
}
