<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class plainController extends Controller
{
    public function plain(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.plain.plain', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('login');
        }
    }
}
