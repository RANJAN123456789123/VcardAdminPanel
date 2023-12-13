<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class nfsController extends Controller
{
    public function nfs(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.nfs.nfs', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('login');
        }
    }
}
