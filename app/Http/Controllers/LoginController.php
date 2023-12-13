<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\userModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\roleModel;
use App\Models\vCard_templateModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\vcardAddModel;

class LoginController extends Controller
{


    public function customLogin(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $remember = $request->input('rememberme');

            if (empty($email)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please enter your email address',
                ]);
            }
            if (strlen($password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'password must be at least 6 characters',
                ]);
            }
            if (empty($password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please enter your password',
                ]);
            }
            $checkemail = userModel::where('email', $email)->first();

            if ($checkemail) {
                if ($checkemail['user_status'] === 'active') {
                    if (Hash::check($password, $checkemail->password)) {

                        Session::put('userId', $checkemail->id);
                        Session::put('name', $checkemail->name);
                        Session::put('email', $checkemail->email);

                        $getSession = Session::get('userId');
                        $rolecheck = userModel::find($getSession);
                        if (!$rolecheck) {
                            return response()->json([
                                'status' => 404,
                                'message' => 'Your role is inactive',
                            ]);
                        }

                        $rolestatus = $rolecheck->rolemodel ? $rolecheck->rolemodel->role_status : null;
                        if (!$rolestatus || $rolestatus === 'inactive') {
                            return response()->json([
                                'status' => 404,
                                'message' => 'Your role is not defined',
                            ]);
                        }


                        if ($remember) {
                            $rememberToken = Str::random(64);
                            userModel::where('id', $checkemail->id)->update([
                                'remember_token' => $rememberToken,
                                'remember_token_expires_at' => now()->addDays(7)
                            ]);
                        }

                        return response()->json([
                            'status' => 200,
                            'message' => 'Login successful',
                            'redirect' => url('dashboard')
                        ]);
                    } else {
                        return response()->json([
                            'status' => 404,
                            'message' => 'Your password is incorrect'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Your email is not active',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Your email is not registered',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function customRegister(Request $request)
    {
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            // $company_name_id = $request->input('company_name_id');
            // $plain_id = $request->input('plain_id');
            // $refer_company_id = $request->input('refer_company_id');
            $password = $request->input('password');
            $confirm_password = $request->input('c_password');
            // $themeimage_id = $request->input('themeimage_id');

            if (empty($name)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Name is required',
                ]);
            }

            if (empty($email)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email is required',
                ]);
            }

            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (!preg_match($regex, $email)) {

                return response()->json([
                    'status' => 404,
                    'message' => 'Email format is not valid',
                ]);
            }


            // if (empty($company_name_id)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'company name is required',
            //     ]);
            // }

            // if (empty($plain_id)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Plain name is required',
            //     ]);
            // }


            // if (empty($refer_company_id)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Refer name is required',
            //     ]);
            // }

            // if (empty($themeimage_id)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Theme is required',
            //     ]);
            // }

            if (empty($password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password is required',
                ]);
            }

            if (empty($confirm_password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Confirm Password is required',
                ]);
            }


            if (strlen($password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password must be at least 6 characters',
                ]);
            }

            if (strlen($confirm_password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Confirm Password must be at least 6 characters',
                ]);
            }

            if ($password != $confirm_password) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Passwords do not match',
                ]);
            }

            $alreadyEmail = UserModel::where('email', $email)->first();
            if ($alreadyEmail) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email already exists',
                ]);
            }

            $hashedPassword = Hash::make($password);

            $user = new UserModel();

            $storeData = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                // 'company_name_id' => $company_name_id,
                // 'plain_id' => $plain_id,
                // 'refer_company_id' => $refer_company_id,
                // 'themeimage_id' => $themeimage_id,
            ];

            // if (!empty($themeimage)) {
            //     $imageName = time() . '_' . $themeimage->getClientOriginalName();
            //     $themeimage->move(public_path('admin/uploads/users'), $imageName);
            //     $storeData['themeimage'] = $imageName;
            // }

            $dataInserted = $user->create($storeData);

            if ($dataInserted) {
                // $imagephto = $dataInserted['themeimage'] ?? null;
                // $data = [
                //     'name' => $name,
                //     'email' => $email,
                //     'password' => $hashedPassword,
                //     'company_name_id' => $company_name_id,
                //     'plain_id' => $plain_id,
                //     'refer_company_id' => $refer_company_id,
                //     'themeimage' => !empty($themeimage) ? $imageName : null,
                //     'image_url' => $imagephto ? url('admin/uploads/users/' . $imagephto) : null,
                // ];

                return response()->json([
                    'status' => 200,
                    'message' => 'Registered successfully',
                    'data' => $dataInserted,
                    'redirect' => url('login')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data insertion failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function dashboard(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.dashboard', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('login');
    }


    public function vcardLogin(Request $request, $id)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $remember = $request->input('rememberme');

            if (empty($email)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please enter your email address',
                ]);
            }
            if (strlen($password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'password must be at least 6 characters',
                ]);
            }
            if (empty($password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Please enter your password',
                ]);
            }


            $checkemail = userModel::where('email', $email)->first();
            if ($checkemail) {

                $checkid = userModel::where('id', $id)->where('email', $email)->first();

                if ($checkid) {

                    if (Hash::check($password, $checkemail->password)) {

                        Session::put('userId', $checkemail->id);
                        Session::put('name', $checkemail->name);
                        Session::put('email', $checkemail->email);

                        $getSession = Session::get('userId');
                        $rolecheck = userModel::find($getSession);
                        if (!$rolecheck) {
                            return response()->json([
                                'status' => 404,
                                'message' => 'Your role is inactive',
                            ]);
                        }
                        if ($remember) {
                            $rememberToken = Str::random(64);
                            userModel::where('id', $checkemail->id)->update([
                                'remember_token' => $rememberToken,
                                'remember_token_expires_at' => now()->addDays(7)
                            ]);
                        }

                        return response()->json([
                            'status' => 200,
                            'message' => 'Login successful',
                            'redirect' => url('vcardEdit')
                        ]);
                    } else {
                        return response()->json([
                            'status' => 404,
                            'message' => 'Your password is incorrect'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Your email and id is not valid',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Your email is not registered',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function vcardRegistger(Request $request, $nfcid)
    {
        try {


            $name = $request->input('name');
            $email = $request->input('email');
            // $cardid = $request->input('nfc_id');
            $password = $request->input('password');
            $confirm_password = $request->input('c_password');

            if (empty($name)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Name is required',
                ]);
            }

            if (empty($email)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email is required',
                ]);
            }

            // if (empty($cardid)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Card id is required',
            //     ]);
            // }

            // $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            // if (!preg_match($regex, $email)) {

            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Email format is not valid',
            //     ]);
            // }



            if (empty($password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password is required',
                ]);
            }

            if (empty($confirm_password)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Confirm Password is required',
                ]);
            }


            if (strlen($password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password must be at least 6 characters',
                ]);
            }

            if (strlen($confirm_password) < 6) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Confirm Password must be at least 6 characters',
                ]);
            }

            if ($password != $confirm_password) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Passwords do not match',
                ]);
            }


            // $alreadynfc = UserModel::where('nfc_id', $cardid)->first();
            // if ($alreadynfc) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Card id already exists',
            //     ]);
            // }

            $alreadyEmail = UserModel::where('email', $email)->first();
            if ($alreadyEmail) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email already exists',
                ]);
            }

            $hashedPassword = Hash::make($password);

            $storeData = [
                'name' => $name,
                'email' => $email,
                // 'nfc_id' => $cardid,
                'password' => $hashedPassword,

            ];

            $getupdate = UserModel::where('nfc_id', $nfcid)->update($storeData);
            $nfcid = UserModel::where('nfc_id', $nfcid)->first();
            $getid = $nfcid->id;
            if ($getupdate) {

                return response()->json([
                    'status' => 200,
                    'message' => 'Registered successfully',
                    'redirect' => url('vcard-login/' . $getid)
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data insertion failed',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function vcard_dashboard(Request $request)
    {
        if ($request->session()->get('userId')) {
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.vcardTemplate.vcardEdit', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } else {
            return redirect()->route('vcardLogin.post');
        }
    }

    public function vcardEdit(Request $request)
    {
        if ($request->session()->get('userId')) {
            $userid = Session::get('userId');
            $userfdata = userModel::where('id', $userid)->first();

            $getallcards = vCard_templateModel::all();
            $gettempelate = vcardAddModel::where('userid', $userid)->first();

            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.vcardTemplate.vcardEdit', ['gettempelate' => $gettempelate, 'getallcards' => $getallcards, 'sessionName' => $sessionName, 'sessionEmail' => $sessionEmail, 'userid' => $userid, 'userfdata' => $userfdata]);
        } else {
            return redirect()->route('vcardLogin.post');
        }
    }

    public function vcardcheckUser($nfcid)
    {
        try {
            $checkuser = userModel::where('nfc_id', $nfcid)->first();
            if ($checkuser) {
                $getid = $checkuser->id;
                $getemail = $checkuser->email;
                //if email is not provided then by defailt  template 11 is automatically intgrated
                $getUserData = userModel::where('id', $getid)->first();
                $loginUser = 'login';
                $vcardmodel = vcardAddModel::where('userid', $getid)->first();
                if ($vcardmodel !== null && $vcardmodel->vcard_id !== null) {
                    if ($getemail) { //if email is provided then this condition will be checked
                        $getTemplate = vCard_templateModel::where('id', $vcardmodel->vcard_id)->first();
                        if ($getTemplate->template_name === 'vcard1') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard1', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard2') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard2', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard3') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard3', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard4') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard4', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard5') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard5', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard6') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard6', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard7') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard7', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard8') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard8', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard9') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard9', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard10') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard10', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } elseif ($getTemplate->template_name === 'vcard11') {

                            return view('admin.vcardTemplate.uservCardTmp.vcard11', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                        } else {
                            return 'not found template';
                        }
                    } else {
                        //if email is not avialable on the user then this condition is executed by default
                        return view('admin.vcardTemplate.uservCardTmp.vcard11', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                    }
                } else {
                    //if email is null so then after this condition will throw
                    return view('admin.vcardTemplate.uservCardTmp.vcard11', ['getUserData' => $getUserData, 'loginUser' => $loginUser]);
                }
            } else {
                return view('admin.vcardTemplate.404notfound');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function editcardDetails(Request $request)
    {
        try {
            $id = $request->input('id');

            $vcard_id = $request->input('vcard_id') ?? 'NA';

            $name = $request->input('name');
            $email = $request->input('email');
            $designation = $request->input('designation');
            $formattedDOB = $request->input('DOB');
            $DOB = date('Y-m-d', strtotime(str_replace('-', '/', $formattedDOB)));
            $phone_number = $request->input('phone_number');
            $location = $request->input('location');
            $profilePic = $request->file('profile_pic');

            $websiteURL = $request->input('websiteURL');
            $instagramURL = $request->input('instagramURL');
            $youtubeURL = $request->input('youtubeURL');
            $linkedinURL = $request->input('linkedinURL');
            $whatsappURL = $request->input('whatsappURL');

            $gstNumber = $request->input('gstNumber');
            $bankname = $request->input('bankname');
            $accountnumber = $request->input('accountnumber');
            $branch = $request->input('branch');
            $ifsccode = $request->input('ifsccode');

            $company_name = $request->input('company_name');

            $icon1 = $request->file('icon1');
            $icon2 = $request->file('icon2');
            $icon3 = $request->file('icon3');
            $icon4 = $request->file('icon4');
            $icon5 = $request->file('icon5');
            $icon6 = $request->file('icon6');



            $title1 = $request->input('title1') ?? 'NA';
            $description1 = $request->input('description1') ?? 'NA';

            $title2 = $request->input('title2') ?? 'NA';
            $description2 = $request->input('description2') ?? 'NA';

            $title3 = $request->input('title3') ?? 'NA';
            $description3 = $request->input('description3') ?? 'NA';

            $title4 = $request->input('title4') ?? 'NA';
            $description4 = $request->input('description4') ?? 'NA';

            $title5 = $request->input('title5') ?? 'NA';
            $description5 = $request->input('description5') ?? 'NA';

            $title6 = $request->input('title6') ?? 'NA';
            $description6 = $request->input('description6') ?? 'NA';


            // gallery and video


            $galleryImagepic = $request->file('galleryImage');

            $videoFile = $request->file('videoFile');


            //proudct1 image upload
            $productimage1 = $request->file('productimage1');
            $producttitle1 = $request->input('producttitle1') ?? 'NA';
            $productdescription1 = $request->input('productdescription1') ?? 'NA';
            $productprice1 = $request->input('productprice1') ?? 'NA';

            //proudct2 image upload
            $productimage2 = $request->file('productimage2');
            $producttitle2 = $request->input('producttitle2') ?? 'NA';
            $productdescription2 = $request->input('productdescription2') ?? 'NA';
            $productprice2 = $request->input('productprice2') ?? 'NA';


            //proudct3 image upload
            $productimage3 = $request->file('productimage3');
            $producttitle3 = $request->input('producttitle3') ?? 'NA';
            $productdescription3 = $request->input('productdescription3') ?? 'NA';
            $productprice3 = $request->input('productprice3') ?? 'NA';

            //proudct4 image upload
            $productimage4 = $request->file('productimage4');
            $producttitle4 = $request->input('producttitle4') ?? 'NA';
            $productdescription4 = $request->input('productdescription4') ?? 'NA';
            $productprice4 = $request->input('productprice4') ?? 'NA';

            //proudct5 image upload
            $productimage5 = $request->file('productimage5');
            $producttitle5 = $request->input('producttitle5') ?? 'NA';
            $productdescription5 = $request->input('productdescription5') ?? 'NA';
            $productprice5 = $request->input('productprice5') ?? 'NA';


            //proudct6 image upload
            $productimage6 = $request->file('productimage6');
            $producttitle6 = $request->input('producttitle6') ?? 'NA';
            $productdescription6 = $request->input('productdescription6') ?? 'NA';
            $productprice6 = $request->input('productprice6') ?? 'NA';

            //Testimonial
            $testmonial1 = $request->file('testmonial1');
            $testimonial_title1 = $request->input('testimonial_title1') ?? 'NA';
            $testimonialDescription1 = $request->input('testimonialDescription1') ?? 'NA';
            $subtitle1 = $request->input('subtitle1') ?? 'NA';

            $testmonial2 =  $request->file('testimonial2');
            $testimonial_title2 = $request->input('testimonial_title2') ?? 'NA';
            $testimonialDescription2 = $request->input('testimonialDescription2') ?? 'NA';
            $subtitle2 = $request->input('subtitle2') ?? 'NA';

            // if (empty($vcard_id)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'Enter new vcard id'
            //     ]);
            // }

            $vcaramodek = vcardAddModel::where('userid', $id)->first();
            if ($vcaramodek) {
                $datavcardid = ['vcard_id' => $vcard_id];
                vcardAddModel::where('userid', $id)->update($datavcardid);
            } else {
                $createdata = ['userid' => $id, 'vcard_id' => $vcard_id];
                vcardAddModel::where('userid', $id)->create($createdata);
            }

            $userpic = userModel::find($id);

            if (empty($profilePic)) {
                $profileImageName = $userpic->profile_pic;
            } else {
                $destinationPath = 'admin/uploads/users';
                $profileImageName = uniqid() . '_' . $profilePic->getClientOriginalName();
                $profilePic->move($destinationPath, $profileImageName);
            }


            if (empty($icon1)) {
                $iconImage1 = $userpic->icon1;
            } else {
                $destinationPath = 'our_services/';
                $iconImage1 = uniqid() . '_' . $icon1->getClientOriginalName();
                $icon1->move($destinationPath, $iconImage1);
            }



            if (empty($icon2)) {
                $iconImage2 = $userpic->icon2;
            } else {
                $destinationPath = 'our_services/';
                $iconImage2 = uniqid() . '_' . $icon2->getClientOriginalName();
                $icon2->move($destinationPath, $iconImage2);
            }


            if (empty($icon3)) {
                $iconImage3 = $userpic->icon3;
            } else {
                $destinationPath = 'our_services/';
                $iconImage3 = uniqid() . '_' . $icon3->getClientOriginalName();
                $icon3->move($destinationPath, $iconImage3);
            }

            if (empty($icon4)) {
                $iconImage4 = $userpic->icon4;
            } else {
                $destinationPath = 'our_services/';
                $iconImage4 = uniqid() . '_' . $icon4->getClientOriginalName();
                $icon4->move($destinationPath, $iconImage4);
            }

            if (empty($icon5)) {
                $iconImage5 = $userpic->icon5;
            } else {
                $destinationPath = 'our_services/';
                $iconImage5 = uniqid() . '_' . $icon5->getClientOriginalName();
                $icon5->move($destinationPath, $iconImage5);
            }

            if (empty($icon6)) {
                $iconImage6 = $userpic->icon6;
            } else {
                $destinationPath = 'our_services/';
                $iconImage6 = uniqid() . '_' . $icon6->getClientOriginalName();
                $icon6->move($destinationPath, $iconImage6);
            }

            if (empty($galleryImagepic)) {
                $gallerypicimage = $userpic->galleryImage;
            } else {
                $destinationPath = 'Gallery/';
                $gallerypicimage = uniqid() . '_' . $galleryImagepic->getClientOriginalName();
                $galleryImagepic->move($destinationPath, $gallerypicimage);
            }


            if (empty($videoFile)) {
                $galleryvideo = $userpic->videoFile;
            } else {
                $destinationPath = 'videoGallery/';
                $galleryvideo = uniqid() . '_' . $videoFile->getClientOriginalName();
                $videoFile->move($destinationPath, $galleryvideo);
            }


            // product all image

            if (empty($productimage1)) {
                $productimagepic1 = $userpic->productimage1;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic1 = uniqid() . '_' . $productimage1->getClientOriginalName();
                $productimage1->move($destinationPath, $productimagepic1);
            }

            if (empty($productimage2)) {
                $productimagepic2 = $userpic->productimage2;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic2 = uniqid() . '_' . $productimage2->getClientOriginalName();
                $productimage2->move($destinationPath, $productimagepic2);
            }

            if (empty($productimage3)) {
                $productimagepic3 = $userpic->productimage3;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic3 = uniqid() . '_' . $productimage3->getClientOriginalName();
                $productimage3->move($destinationPath, $productimagepic3);
            }


            if (empty($productimage4)) {
                $productimagepic4 = $userpic->productimage4;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic4 = uniqid() . '_' . $productimage4->getClientOriginalName();
                $productimage4->move($destinationPath, $productimagepic4);
            }


            if (empty($productimage5)) {
                $productimagepic5 = $userpic->productimage5;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic5 = uniqid() . '_' . $productimage5->getClientOriginalName();
                $productimage5->move($destinationPath, $productimagepic5);
            }

            if (empty($productimage6)) {
                $productimagepic6 = $userpic->productimage6;
            } else {
                $destinationPath = 'productGallery/';
                $productimagepic6 = uniqid() . '_' . $productimage6->getClientOriginalName();
                $productimage6->move($destinationPath, $productimagepic6);
            }


            if (empty($testmonial1)) {
                $testmonialimage1 = $userpic->testmonial1;
            } else {
                $destinationPath = 'testmonial/';
                $testmonialimage1 = uniqid() . '_' . $testmonial1->getClientOriginalName();
                $testmonial1->move($destinationPath, $testmonialimage1);
            }

            if (empty($testmonial2)) {
                $testmonialimage2 = $userpic->testimonial2;
            } else {
                $destinationPath = 'testmonial/';
                $testmonialimage2 = uniqid() . '_' . $testmonial2->getClientOriginalName();
                $testmonial2->move($destinationPath, $testmonialimage2);
            }


            $getname = $name ? $name : $userpic->name;
            $getemail = $email ? $email : $userpic->email;
            $getdesignation = $designation ? $designation : $userpic->designation;
            $getDOB = $DOB ? $DOB : $userpic->DOB;
            $getphone_number = $phone_number ? $phone_number : $userpic->phone_number;
            $getlocation = $location ? $location  : $userpic->location;

            $getwebsiteURL = $websiteURL ? $websiteURL  : $userpic->websiteURL;
            $getinstagramURL = $instagramURL ? $instagramURL  : $userpic->instagramURL;
            $getyoutubeURL = $youtubeURL ? $youtubeURL  : $userpic->youtubeURL;
            $getlinkedinURL = $linkedinURL ? $linkedinURL  : $userpic->linkedinURL;
            $getwhatsappURL = $whatsappURL ? $whatsappURL  : $userpic->whatsappURL;

            $getgstNumber = $gstNumber ? $gstNumber  : $userpic->gstNumber;
            $getbankname = $bankname ? $bankname  : $userpic->bankname;
            $getaccountnumber = $accountnumber ? $accountnumber  : $userpic->accountnumber;

            $getbranch = $branch ? $branch  : $userpic->branch;
            $getifsccode = $ifsccode ? $ifsccode  : $userpic->ifsccode;

            $getcompany_name = $company_name ? $company_name  : $userpic->company_name;

            $gettitle1 = $title1 ? $title1  : $userpic->title1;
            $getdescription1 = $description1 ? $description1  : $userpic->description1;

            $gettitle2 = $title2 ? $title2  : $userpic->title2;
            $getdescription2 = $description2 ? $description2  : $userpic->description2;

            $gettitle3 = $title3 ? $title3  : $userpic->title3;
            $getdescription3 = $description3 ? $description3  : $userpic->description3;

            $gettitle4 = $title4 ? $title4  : $userpic->title4;
            $getdescription4 = $description4 ? $description4  : $userpic->description4;

            $gettitle5 = $title5 ? $title5  : $userpic->title5;
            $getdescription5 = $description5 ? $description5  : $userpic->description5;

            $gettitle6 = $title6 ? $title6  : $userpic->title6;
            $getdescription6 = $description6 ? $description6  : $userpic->description6;


            //pproduct ttitlr all attributes
            $getproducttitle1 = $producttitle1 ? $producttitle1  : $userpic->producttitle1;

            $getproducttitle2 = $producttitle2 ? $producttitle2  : $userpic->producttitle2;

            $getproducttitle3 = $producttitle3 ? $producttitle3  : $userpic->producttitle3;

            $getproducttitle4 = $producttitle4 ? $producttitle4  : $userpic->producttitle4;

            $getproducttitle5 = $producttitle5 ? $producttitle5  : $userpic->producttitle5;

            $getproducttitle6 = $producttitle6 ? $producttitle6  : $userpic->producttitle6;

            //pproduct productdescription
            $getproductdescription1 = $productdescription1 ? $productdescription1  : $userpic->productdescription1;

            $getproductdescription2 = $productdescription2 ? $productdescription2  : $userpic->productdescription2;

            $getproductdescription3 = $productdescription3 ? $productdescription3  : $userpic->productdescription3;

            $getproductdescription4 = $productdescription4 ? $productdescription4  : $userpic->productdescription4;

            $getproductdescription5 = $productdescription5 ? $productdescription5  : $userpic->productdescription5;

            $getproductdescription6 = $productdescription6 ? $productdescription6  : $userpic->productdescription6;

            //pproduct productprice1
            $getproductprice1 = $productprice1 ? $productprice1  : $userpic->productprice1;

            $getproductprice2 = $productprice2 ? $productprice2  : $userpic->productprice2;

            $getproductprice3 = $productprice3 ? $productprice3  : $userpic->productprice3;

            $getproductprice4 = $productprice4 ? $productprice4  : $userpic->productprice4;

            $getproductprice5 = $productprice5 ? $productprice5  : $userpic->productprice5;

            $getproductprice6 = $productprice6 ? $productprice6  : $userpic->productprice6;


            // testimonial
            $gettestimonial_title1 = $testimonial_title1 ? $testimonial_title1  : $userpic->testimonial_title1;
            $gettestimonialDescription1 = $testimonialDescription1 ? $testimonialDescription1  : $userpic->testimonialDescription1;
            $getsubtitle1 = $subtitle1 ? $subtitle1  : $userpic->subtitle1;

            $gettestimonial_title2 = $testimonial_title2 ? $testimonial_title2  : $userpic->testimonial_title2;
            $gettestimonialDescription2 = $testimonialDescription2 ? $testimonialDescription2  : $userpic->testimonialDescription2;
            $getsubtitle2 = $subtitle2 ? $subtitle2  : $userpic->subtitle2;


            $updateData = [
                'profile_pic' => $profileImageName,
                'name' => $getname,
                'email' => $getemail,
                'designation' => $getdesignation,
                'DOB' => $getDOB,
                'phone_number' => $getphone_number,
                'location' => $getlocation,

                'websiteURL' => $getwebsiteURL,
                'instagramURL' => $getinstagramURL,
                'youtubeURL' => $getyoutubeURL,
                'linkedinURL' => $getlinkedinURL,
                'whatsappURL' => $getwhatsappURL,

                'gstNumber' => $getgstNumber,
                'bankname' => $getbankname,
                'accountnumber' => $getaccountnumber,

                'branch' => $getbranch,
                'ifsccode' => $getifsccode,
                'company_name' => $getcompany_name,
                'icon1' => $iconImage1,
                'icon2' => $iconImage2,
                'icon3' => $iconImage3,
                'icon4' => $iconImage4,
                'icon5' => $iconImage5,
                'icon6' => $iconImage6,

                'title1' => $gettitle1,
                'description1' => $getdescription1,

                'title2' => $gettitle2,
                'description2' => $getdescription2,

                'title3' => $gettitle3,
                'description3' => $getdescription3,

                'title4' => $gettitle4,
                'description4' => $getdescription4,

                'title5' => $gettitle5,
                'description5' => $getdescription5,

                'title6' => $gettitle6,
                'description6' => $getdescription6,

                'galleryImage' => $gallerypicimage,
                'videoFile' => $galleryvideo,

                'producttitle1' => $getproducttitle1,
                'producttitle2' => $getproducttitle2,
                'producttitle3' => $getproducttitle3,
                'producttitle4' => $getproducttitle4,
                'producttitle5' => $getproducttitle5,
                'producttitle6' => $getproducttitle6,

                'productdescription1' => $getproductdescription1,
                'productdescription2' => $getproductdescription2,
                'productdescription3' => $getproductdescription3,
                'productdescription4' => $getproductdescription4,
                'productdescription5' => $getproductdescription5,
                'productdescription6' => $getproductdescription6,

                'productprice1' => $getproductprice1,
                'productprice2' => $getproductprice2,
                'productprice3' => $getproductprice3,
                'productprice4' => $getproductprice4,
                'productprice5' => $getproductprice5,
                'productprice6' => $getproductprice6,

                'productimage1' => $productimagepic1,
                'productimage2' => $productimagepic2,
                'productimage3' => $productimagepic3,
                'productimage4' => $productimagepic4,
                'productimage5' => $productimagepic5,
                'productimage6' => $productimagepic6,

                'testmonial1' => $testmonialimage1,
                'testimonial2' => $testmonialimage2,

                'testimonial_title1' => $gettestimonial_title1,
                'subtitle1' => $getsubtitle1,
                'testimonialDescription1' => $gettestimonialDescription1,

                'testimonial_title2' => $gettestimonial_title2,
                'subtitle2' => $getsubtitle2,
                'testimonialDescription2' => $gettestimonialDescription2

            ];

            $user = userModel::find($id);

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found'
                ]);
            }
            // Session::getHandler()->destroy($id);
            $user->update($updateData);



            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
                'redirect' => url("vcardcheckUser/$user->nfc_id")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create_vcard_details($data)
    {
        // if not used - leave blank!
        $name = $data->person_name . ";";
        $addressLabel     = 'Our Office';
        $addressPobox     = '';
        $addressExt       = '';
        $addressStreet    = $data->address;
        $addressTown      = $data->city;
        $addressRegion    = $data->state;
        $addressPostCode  = $data->pincode;
        $addressCountry   = 'India';

        // we building raw data
        $codeContents  = 'BEGIN:VCARD' . "\n";
        $codeContents .= 'VERSION:3.0' . "\n";
        $codeContents .= 'N:' . $name . "\n";
        $codeContents .= 'FN:' . $data->person_name . "\n";
        $codeContents .= 'ORG:' . $data->company_name . "\n";
        $codeContents .= 'EMAIL;TYPE=INTERNET:' . $data->email . "\n";
        $codeContents .= 'URL:' . $data->website . "\n";
        $codeContents .= 'TEL;TYPE=CELL:' . $data->mobile . "\n";
        $codeContents .= 'TEL:' . $data->officeno . "\n";

        $codeContents .= 'ADR;TYPE=work;' .
            'LABEL="' . $addressLabel . '":'
            . $addressPobox . ';'
            . $addressExt . ';'
            . $addressStreet . ';'
            . $addressTown . ';'
            . $addressRegion . ';'
            . $addressPostCode . ';'
            . $addressCountry
            . "\n";

        $codeContents .= 'END:VCARD';

        return $codeContents;
    }

    public function viewQrcodeTapCard()
    {
        return view('admin.qrcodeTapid.qrcodeTap');
    }

    public function createQrcodeTapCard(Request $request)
    {

        try {

            $nfcid = $request->input('nfc_id');
            $checknfsccard = userModel::where('nfc_id', $nfcid)->first();

            if (empty($nfcid)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter tap id',
                ]);
            }
            if ($checknfsccard) {

                $getarr = array(
                    'nfc_id' => $checknfsccard->nfc_id,
                    'qr_code' => $checknfsccard->qr_code
                );

                return response()->json([
                    'status' => 200,
                    'message' => 'Already qr generated',
                    'data' => $getarr,
                ]);
            } else {
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                $currentPort = $_SERVER['SERVER_PORT'];
                $host =  getHostByName(getHostName());
                $from = [255, 0, 0];
                $to = [0, 0, 255];

                $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $nfcid;

                // return $userurl;

                $qrcodeFormat = QrCode::format('png')
                    ->style('dot')
                    ->eye('circle')
                    ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                    ->margin(1)
                    ->generate($userurl);

                $directory = public_path('qrcodeprimary');
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $timestamp = now()->timestamp;
                $filename = 'generated_qr_code_' . $timestamp . '.png';
                $filePath = $directory . DIRECTORY_SEPARATOR . $filename;

                file_put_contents($filePath, $qrcodeFormat);

                $imageURL = asset('qrcodeprimary/' . $filename);

                $registerUser = $imageURL;
                if ($registerUser) {
                    $newcardenter = userModel::create(['nfc_id' => $nfcid, 'qr_code' => $filename]);
                    if ($newcardenter) {
                        return response()->json([
                            'status' => 200,
                            'message' => 'New Qr Code generated successfully',
                            'redirect' => url($registerUser)
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
