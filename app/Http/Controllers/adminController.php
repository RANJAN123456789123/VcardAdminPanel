<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\userModel;
use App\Helpers\AllButtonAccessHelper;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('userId')) {
                $this->session($request);
            } elseif ($request->route()->getActionMethod() !== '') {
                return redirect()->route('login');
            }

            return $next($request);
        });
    }

    private function session()
    {
        $sessionName = Session::get('name');
        $sessionEmail = Session::get('email');
        view()->share('sessionName', $sessionName);
        view()->share('sessionEmail', $sessionEmail);
    }

    public function adminPage(Request $request)
    {
        $userModel = new userModel();
        $adminCreateButton = new AllButtonAccessHelper($userModel);
        $adminCreate = $adminCreateButton->checkPermissionForAction($request, 'create');
        return view('admin.adminPage.adminPage', compact('adminCreate'));
    }
}
