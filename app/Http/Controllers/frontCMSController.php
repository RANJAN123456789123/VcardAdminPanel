<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class frontCMSController extends Controller
{
    public function frontCMS(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.frontCMS.frontCMS', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('login');
        }
    }
}
