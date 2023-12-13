<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\roleModel;
use App\Models\userModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('userId')) {
                $this->session($request);
            } elseif ($request->route()->getActionMethod() !== 'AddFormUsers' && $request->route()->getActionMethod() !== 'userStatusToggle' && $request->route()->getActionMethod() !== 'editFormUser' && $request->route()->getActionMethod() !== 'editPassword' && $request->route()->getActionMethod() !== 'userDelete') {
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

    public function user()
    {
        $alluser = new userModel();
        $alluser = $alluser->latest('created_at', 'asc')->where('table_status', '0')->get();
        return view('admin.user.user', ['alluser' => $alluser]);
    }

    public function adduser()
    {
        $allrole = new roleModel();
        $getallrole = $allrole->where('table_status', '0')->get();
        return view('admin.user.adduser', ['getallrole' => $getallrole]);
    }

    public function AddFormUsers(Request $request)
    {
        try {

            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');
            $role_id = $request->input('role_id');
            $designation = $request->input('designation');
            $formattedDOB = $request->input('DOB');
            $DOB = date('Y-m-d', strtotime(str_replace('-', '/', $formattedDOB)));
            $phone_number = $request->input('phone_number');
            $location = $request->input('location');

            $title1 = $request->input('title1') ?? 'NA';
            $description1 = $request->input('description1') ?? 'NA';

            $title2 = $request->input('title2') ?? 'NA';
            $description2 = $request->input('description2') ?? 'NA';



            $description3 = $request->input('description3') ?? 'NA';

            $title4 = $request->input('title4') ?? 'NA';
            $description4 = $request->input('description4') ?? 'NA';

            $title5 = $request->input('title5') ?? 'NA';
            $description5 = $request->input('description5') ?? 'NA';

            $title6 = $request->input('title6') ?? 'NA';
            $description6 = $request->input('description6') ?? 'NA';

            $profilePic = $request->hasFile('profile_pic') ? $request->file('profile_pic') : 'null';
            $icon1 = $request->hasFile('icon1') ? $request->file('icon1') : 'null';
            $icon2 = $request->hasFile('icon2') ? $request->file('icon2') : 'null';
            $icon3 = $request->hasFile('icon3') ? $request->file('icon3') : 'null';
            $icon4 = $request->hasFile('icon4') ? $request->file('icon4') : 'null';
            $icon5 = $request->hasFile('icon5') ? $request->file('icon5') : 'null';
            $icon6 = $request->hasFile('icon6') ? $request->file('icon6') : 'null';


            $title3 = $request->input('title3') ?? 'NA';
            $videofile = $request->hasFile('videoUpload') ? $request->file('videoUpload') : 'null';
            $galleryImage = $request->hasFile('galleryImage') ? $request->file('galleryImage') : 'null';


            //proudct1 image upload
            $productimage1 = $request->hasFile('productimage1') ? $request->file('productimage1') : 'null';
            $producttitle1 = $request->input('producttitle1') ?? 'NA';
            $productdescription1 = $request->input('productdescription1') ?? 'NA';
            $productprice1 = $request->input('productprice1') ?? 'NA';

            //proudct2 image upload
            $productimage2 = $request->hasFile('productimage2') ? $request->file('productimage2') : 'null';
            $producttitle2 = $request->input('producttitle2') ?? 'NA';
            $productdescription2 = $request->input('productdescription2') ?? 'NA';
            $productprice2 = $request->input('productprice2') ?? 'NA';


            //proudct3 image upload
            $productimage3 = $request->hasFile('productimage3') ? $request->file('productimage3') : 'null';
            $producttitle3 = $request->input('producttitle3') ?? 'NA';
            $productdescription3 = $request->input('productdescription3') ?? 'NA';
            $productprice3 = $request->input('productprice3') ?? 'NA';

            //proudct4 image upload
            $productimage4 = $request->hasFile('productimage4') ? $request->file('productimage4') : 'null';
            $producttitle4 = $request->input('producttitle4') ?? 'NA';
            $productdescription4 = $request->input('productdescription4') ?? 'NA';
            $productprice4 = $request->input('productprice4') ?? 'NA';

            //proudct5 image upload
            $productimage5 = $request->hasFile('productimage5') ? $request->file('productimage5') : 'null';
            $producttitle5 = $request->input('producttitle5') ?? 'NA';
            $productdescription5 = $request->input('productdescription5') ?? 'NA';
            $productprice5 = $request->input('productprice5') ?? 'NA';


            //proudct6 image upload
            $productimage6 = $request->hasFile('productimage6') ? $request->file('productimage6') : 'null';
            $producttitle6 = $request->input('producttitle6') ?? 'NA';
            $productdescription6 = $request->input('productdescription6') ?? 'NA';
            $productprice6 = $request->input('productprice6') ?? 'NA';


            //Testimonial
            $testmonial1 = $request->hasFile('testmonial1') ? $request->file('testmonial1') : 'null';
            $testimonial_title1 = $request->input('testimonial_title1') ?? 'NA';
            $testimonialDescription1 = $request->input('testimonialDescription1') ?? 'NA';
            $subtitle1 = $request->input('subtitle1') ?? 'NA';

            $testmonial2 = $request->hasFile('testimonial2') ? $request->file('testimonial2') : 'null';
            $testimonial_title2 = $request->input('testimonial_title2') ?? 'NA';
            $testimonialDescription2 = $request->input('testimonialDescription2') ?? 'NA';
            $subtitle2 = $request->input('subtitle2') ?? 'NA';


            $mondaystart = $request->input('mondaystart') ?? 'NA';
            $mondayend = $request->input('mondayend') ?? 'NA';
            $tuesdaystart = $request->input('tuesdaystart') ?? 'NA';
            $tuesdayend = $request->input('tuesdayend') ?? 'NA';

            $wednesdaystart = $request->input('wednesdaystart') ?? 'NA';
            $wednesdayend = $request->input('wednesdayend') ?? 'NA';
            $thursdaystart = $request->input('thursdaystart') ?? 'NA';
            $thursdayend = $request->input('thursdayend') ?? 'NA';

            $fridaystart = $request->input('fridaystart') ?? 'NA';
            $fridayend = $request->input('fridayend') ?? 'NA';
            $saturdaystart = $request->input('saturdaystart') ?? 'NA';
            $saturdayend = $request->input('saturdayend') ?? 'NA';


            if ($profilePic !== 'null') {
                $request->validate([
                    'profile_pic' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($icon1 !== 'null') {
                $request->validate([
                    'icon1' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }
            if ($icon2 !== 'null') {
                $request->validate([
                    'icon2' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($icon3 !== 'null') {
                $request->validate([
                    'icon3' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($icon4 !== 'null') {
                $request->validate([
                    'icon4' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($icon5 !== 'null') {
                $request->validate([
                    'icon5' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($icon6 !== 'null') {
                $request->validate([
                    'icon6' => 'file|mimes:jpg,jpeg,png,webp|max:2048',

                ]);
            }

            if ($galleryImage  !== 'null') {
                $request->validate([
                    'galleryImage' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }


            if ($videofile  !== 'null') {
                $request->validate([
                    'videoFile' => 'file|mimes:mp4|max:2048',
                ]);
            }

            if ($productimage1  !== 'null') {
                $request->validate([
                    'productimage1' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($productimage2  !== 'null') {
                $request->validate([
                    'productimage2' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($productimage3  !== 'null') {
                $request->validate([
                    'productimage3' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($productimage4  !== 'null') {
                $request->validate([
                    'productimage4' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }


            if ($productimage5  !== 'null') {
                $request->validate([
                    'productimage5' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($productimage6  !== 'null') {
                $request->validate([
                    'productimage6' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($testmonial1  !== 'null') {
                $request->validate([
                    'testmonial1' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            if ($testmonial2  !== 'null') {
                $request->validate([
                    'testimonial2' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
            }

            $defaultFile = 'NA';

            //our services file
            $profileImageName = $profilePic ? $profilePic : $defaultFile;
            $iconImage1 = $icon1 ? $icon1 : $defaultFile;
            $iconImage2 = $icon2 ? $icon2 : $defaultFile;
            $iconImage3 = $icon3 ? $icon3 : $defaultFile;
            $iconImage4 = $icon4 ? $icon4 : $defaultFile;
            $iconImage5 = $icon5 ? $icon5 : $defaultFile;
            $iconImage6 = $icon6 ? $icon6 : $defaultFile;

            //Gallery file
            $videoFilesupload = $videofile ? $videofile : $defaultFile;
            $galleryImageUpload = $galleryImage ? $galleryImage : $defaultFile;


            //product file
            $productFilesupload1 = $productimage1 ? $productimage1 : $defaultFile;
            $productFilesupload2 = $productimage2 ? $productimage2 : $defaultFile;
            $productFilesupload3 = $productimage3 ? $productimage3 : $defaultFile;
            $productFilesupload4 = $productimage4 ? $productimage4 : $defaultFile;
            $productFilesupload5 = $productimage5 ? $productimage5 : $defaultFile;
            $productFilesupload6 = $productimage6 ? $productimage6 : $defaultFile;

            //testimonial file
            $testimonialuploadfile = $testmonial1 ? $testmonial1 : $defaultFile;
            $testimonialuploadfile1 = $testmonial2 ? $testmonial2 : $defaultFile;


            //Bussiness hours
            $mondaystart1 = $mondaystart ? $mondaystart : $defaultFile;
            $mondayend1 = $mondayend ? $mondayend : $defaultFile;
            $tuesdaystart1 = $tuesdaystart ? $tuesdaystart : $defaultFile;
            $tuesdayend1 = $tuesdayend ? $tuesdayend : $defaultFile;

            $wednesdaystart1 = $wednesdaystart ? $wednesdaystart : $defaultFile;
            $wednesdayend1 = $wednesdayend ? $wednesdayend : $defaultFile;
            $thursdaystart1 = $thursdaystart ? $thursdaystart : $defaultFile;
            $thursdayend1 = $thursdayend ? $thursdayend : $defaultFile;


            $fridaystart1 = $fridaystart ? $fridaystart : $defaultFile;
            $fridayend1 = $fridayend ? $fridayend : $defaultFile;
            $saturdaystart1 = $saturdaystart ? $saturdaystart : $defaultFile;
            $saturdayend1 = $saturdayend ? $saturdayend : $defaultFile;

            if ($profilePic !== 'null') {
                $destinationPath = 'admin/uploads/users';
                $profileImageName = uniqid() . '_' . $profilePic->getClientOriginalName();
                $profilePic->move($destinationPath, $profileImageName);
                // return $profileImageName;
            } else {
                $profileImageName = $defaultFile;
                // return $profileImageName;
            }

            if ($icon1 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage1 = uniqid() . '_' . $icon1->getClientOriginalName();
                $icon1->move($destinationPath, $iconImage1);
            } else {
                $iconImage1 = $defaultFile;
            }

            if ($icon2 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage2 = uniqid() . '_' . $icon2->getClientOriginalName();
                $icon2->move($destinationPath, $iconImage2);
            } else {
                $iconImage2 = $defaultFile;
            }

            if ($icon3 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage3 = uniqid() . '_' . $icon3->getClientOriginalName();
                $icon3->move($destinationPath, $iconImage3);
            } else {
                $iconImage3 = $defaultFile;
            }

            if ($icon4 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage4 = uniqid() . '_' . $icon4->getClientOriginalName();
                $icon4->move($destinationPath, $iconImage4);
            } else {
                $iconImage4 = $defaultFile;
            }



            if ($icon5 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage5 = uniqid() . '_' . $icon5->getClientOriginalName();
                $icon5->move($destinationPath, $iconImage5);
            } else {
                $iconImage5 = $defaultFile;
            }



            if ($icon6 !== 'null') {
                $destinationPath = 'our_services';
                $iconImage6 = uniqid() . '_' . $icon6->getClientOriginalName();
                $icon6->move($destinationPath, $iconImage6);
            } else {
                $iconImage6 = $defaultFile;
            }


            if ($galleryImage !== 'null') {
                $destinationPath = 'Gallery';
                $galleryImageUpload = uniqid() . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->move($destinationPath, $galleryImageUpload);
            } else {
                $galleryImageUpload = $defaultFile;
            }

            if ($videofile !== 'null') {
                $destinationPath = 'videoGallery';
                $videoFilesupload = uniqid() . '_' . $videofile->getClientOriginalName();
                $videofile->move($destinationPath, $videoFilesupload);
            } else {
                $videoFilesupload = $defaultFile;
            }

            if ($productimage1 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload1 = uniqid() . '_' . $productimage1->getClientOriginalName();
                $productimage1->move($destinationPath, $productFilesupload1);
            } else {
                $productFilesupload1 = $defaultFile;
            }

            if ($productimage2 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload2 = uniqid() . '_' . $productimage2->getClientOriginalName();
                $productimage2->move($destinationPath, $productFilesupload2);
            } else {
                $productFilesupload2 = $defaultFile;
            }

            if ($productimage3 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload3 = uniqid() . '_' . $productimage3->getClientOriginalName();
                $productimage3->move($destinationPath, $productFilesupload3);
            } else {
                $productFilesupload3 = $defaultFile;
            }

            if ($productimage4 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload4 = uniqid() . '_' . $productimage4->getClientOriginalName();
                $productimage4->move($destinationPath, $productFilesupload4);
            } else {
                $productFilesupload4 = $defaultFile;
            }

            if ($productimage5 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload5 = uniqid() . '_' . $productimage5->getClientOriginalName();
                $productimage5->move($destinationPath, $productFilesupload5);
            } else {
                $productFilesupload5 = $defaultFile;
            }


            if ($productimage6 !== 'null') {
                $destinationPath = 'productGallery';
                $productFilesupload6 = uniqid() . '_' . $productimage6->getClientOriginalName();
                $productimage6->move($destinationPath, $productFilesupload6);
            } else {
                $productFilesupload6 = $defaultFile;
            }


            if ($testmonial1 !== 'null') {
                $destinationPath = 'productGallery';
                $testimonialuploadfile = uniqid() . '_' . $testmonial1->getClientOriginalName();
                $testmonial1->move($destinationPath, $testimonialuploadfile);
            } else {
                $testimonialuploadfile = $defaultFile;
            }

            if ($testmonial2 !== 'null') {
                $destinationPath = 'productGallery';
                $testimonialuploadfile1 = uniqid() . '_' . $testmonial2->getClientOriginalName();
                $testmonial2->move($destinationPath, $testimonialuploadfile1);
            } else {
                $testimonialuploadfile1 = $defaultFile;
            }


            $usermodel = new userModel();

            if (empty($name)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter name'
                ]);
            }

            if (empty($email)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter email'
                ]);
            }

            $checkemail = $usermodel->where('email', $email)->first();

            if ($checkemail) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email already exists'
                ]);
            }

            if (empty($designation)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter designation'
                ]);
            }


            if (empty($DOB)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter DOB'
                ]);
            }


            if (empty($phone_number)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter phone number'
                ]);
            }


            if (empty($location)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter location'
                ]);
            }

            if ($password != $confirm_password) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password does not match'
                ]);
            }

            $hashedPassword = Hash::make($password);

            $storeData = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'role_id' => $role_id,
                'designation' => $designation,
                'DOB' => $DOB,
                'phone_number' => $phone_number,
                'location' => $location,
                'profile_pic' => $profileImageName,

                'icon1' => $iconImage1,
                'title1' => $title1,
                'description1' => $description1,

                'icon2' => $iconImage2,
                'title2' => $title2,
                'description2' => $description2,

                'icon3' => $iconImage3,
                'title3' => $title3,
                'description3' => $description3,

                'icon4' => $iconImage4,
                'title4' => $title4,
                'description4' => $description4,

                'icon5' => $iconImage5,
                'title5' => $title5,
                'description5' => $description5,

                'icon6' => $iconImage6,
                'title6' => $title6,
                'description6' => $description6,

                'galleryImage' => $galleryImageUpload,
                'videoFile' => $videoFilesupload,

                'productimage1' => $productFilesupload1,
                'producttitle1' => $producttitle1,
                'productdescription1' => $productdescription1,
                'productprice1' => $productprice1,

                'productimage2' => $productFilesupload2,
                'producttitle2' => $producttitle2,
                'productdescription2' => $productdescription2,
                'productprice2' => $productprice2,

                'productimage3' => $productFilesupload3,
                'producttitle3' => $producttitle3,
                'productdescription3' => $productdescription3,
                'productprice3' => $productprice3,

                'productimage4' => $productFilesupload4,
                'producttitle4' => $producttitle4,
                'productdescription4' => $productdescription4,
                'productprice4' => $productprice4,

                'productimage5' => $productFilesupload5,
                'producttitle5' => $producttitle5,
                'productdescription5' => $productdescription5,
                'productprice5' => $productprice5,

                'productimage6' => $productFilesupload6,
                'producttitle6' => $producttitle6,
                'productdescription6' => $productdescription6,
                'productprice6' => $productprice6,

                'testmonial1' => $testimonialuploadfile,
                'testimonial_title1' => $testimonial_title1,
                'testimonialDescription1' => $testimonialDescription1,
                'subtitle1' => $subtitle1,

                'testimonial2' => $testimonialuploadfile1,
                'testimonial_title2' => $testimonial_title2,
                'testimonialDescription2' => $testimonialDescription2,
                'subtitle2' => $subtitle2,

                'mondaystart' => $mondaystart1,
                'mondayend' => $mondayend1,
                'tuesdaystart' => $tuesdaystart1,
                'tuesdayend' => $tuesdayend1,
                'wednesdaystart' => $wednesdaystart1,
                'wednesdayend' => $wednesdayend1,
                'thursdaystart' => $thursdaystart1,
                'thursdayend' => $thursdayend1,
                'fridaystart' => $fridaystart1,
                'fridayend' => $fridayend1,
                'saturdaystart' => $saturdaystart1,
                'saturdayend' => $saturdayend1

            ];

            $dataInserted = $usermodel->create($storeData);
            if ($dataInserted) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Registered successfully',
                    'data' => $dataInserted,
                    // 'redirect' => url('login')
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
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }


    public function userStatusToggle(Request $request)
    {
        try {

            $userid = $request->input('id');
            $user_status = $request->input('user_status');

            $usermodel = new userModel();

            $checkid = $usermodel->where('id', $userid)->first();

            if (!is_numeric($userid)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User id is not a valid integer',
                ]);
            }

            if (!$checkid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User id not found',
                ]);
            }

            $updateUserToggleStatus = $usermodel->where('id', $userid)->update(['user_status' => $user_status]);

            if ($updateUserToggleStatus > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'User Changed Success'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'User status failed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function editUser($id)
    {
        $usermodel = new UserModel();
        $userEditData = $usermodel->where('id', $id)->first();

        $roleEditdata = new roleModel();
        $geteditrole = $roleEditdata->where('table_status', '0')->get();

        return view('admin.user.editUser', ['userEditData' => $userEditData, 'geteditrole' => $geteditrole]);
    }

    public function editFormUser(Request $request, $id)
    {

        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $role_id = $request->input('role_id');
            $designation = $request->input('designation');
            $formattedDOB = $request->input('DOB');
            $DOB = date('Y-m-d', strtotime(str_replace('-', '/', $formattedDOB)));
            $phone_number = $request->input('phone_number');
            $location = $request->input('location');
            $profilePic = $request->file('profile_pic');

            $userpic = userModel::find($id);
            if (!$profilePic) {
                $profileImageName = $userpic->profile_pic;
            } else {
                if ($profilePic->isValid()) { // Check validity directly without an extra condition
                    $destinationPath = 'admin/uploads/users';
                    $profileImageName = uniqid() . '_' . $profilePic->getClientOriginalName();
                    $profilePic->move($destinationPath, $profileImageName);
                }
            }

            if (empty($name)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Please provide a name'
                ]);
            }

            if (empty($email)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Please provide an email'
                ]);
            }

            if (empty($designation)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter designation'
                ]);
            }


            if (empty($DOB)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter DOB'
                ]);
            }


            if (empty($phone_number)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter phone number'
                ]);
            }


            if (empty($location)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter location'
                ]);
            }

            $updateData = [
                'profile_pic' => $profileImageName,
                'name' => $name,
                'email' => $email,
                'role_id' => $role_id,
                'designation' => $designation,
                'DOB' => $DOB,
                'phone_number' => $phone_number,
                'location' => $location
            ];

            $user = userModel::find($id);

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found'
                ]);
            }

            $user->update($updateData);

            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
                'data' => userModel::find($id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function editPassword(Request $request, $id)
    {
        try {
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');

            if ($password !== $confirm_password) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password does not match',
                ]);
            }

            $hashedPassword = Hash::make($password);
            $updatedRows = userModel::where('id', $id)->update(['password' => $hashedPassword]);

            if ($updatedRows > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Password updated'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Password not updated',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function userDelete(Request $request, $id)
    {
        try {

            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'id is not integer',
                ]);
            }

            $delete = userModel::where('id', $id)->delete();

            if ($delete > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'User deleted successfully',
                    'redirect' => url('user')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not deleted',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
