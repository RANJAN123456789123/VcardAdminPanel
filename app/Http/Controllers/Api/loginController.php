<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    // public function customLogin(Request $request)
    // {
    //     try {
    //         $email = $request->input('email');
    //         $password = $request->input('password');


    //         if (empty($email)) {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'Please enter your email address',
    //             ]);
    //         }
    //         if (strlen($password) < 6) {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'password must be at least 6 characters',
    //             ]);
    //         }
    //         if (empty($password)) {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'Please enter your password',
    //             ]);
    //         }
    //         $checkemil = userModel::where('email', $email)->first();
    //         if ($checkemil) {
    //             if (Hash::check($password, $checkemil->password)) {

    //                 $request->session()->put('userId', $checkemil->id);


    //                 return response()->json([
    //                     'status' => 200,
    //                     'message' => 'Login successfull',
    //                     'redirect' => url('dashboard')

    //                 ]);
    //             } else {
    //                 return response()->json([
    //                     'status' => 404,
    //                     'message' => 'your password is incorrect'
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'your email is not registered',
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 500,
    //             'message' => $e->getMessage()
    //         ]);
    //     };
    // }
}
