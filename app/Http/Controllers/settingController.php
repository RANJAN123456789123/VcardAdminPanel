<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class settingController extends Controller
{
    public function setting(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.setting.setting', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('login');
        }
    }
}
