<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\vCard_templateModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\userModel;
use App\Models\vcardAddModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;



class vcardTemplateController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Session::has('userId')) {
    //             $this->session($request);
    //         } elseif ($request->route()->getActionMethod() !== 'addformvCardTemplate' && $request->route()->getActionMethod() !== 'addformVcard') {
    //             return redirect()->route('login');
    //         }

    //         return $next($request);
    //     });
    // }

    // private function session()
    // {
    //     $sessionName = Session::get('name');
    //     $sessionEmail = Session::get('email');
    //     view()->share('sessionName', $sessionName);
    //     view()->share('sessionEmail', $sessionEmail);
    // }

    public function AddvCardTemplate()
    {
        if (!Session::has('userId')) {
            return redirect()->route('login');
        }

        $sessionName = Session::get('name');
        $sessionEmail = Session::get('email');
        return view('admin.vcardTemplate.addvCardTemplate', ['sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
    }

    public function vcardTemplate(Request $request)
    {
        if (!Session::has('userId')) {
            return redirect()->route('login');
        }
        $sessionName = Session::get('name');
        $sessionEmail = Session::get('email');
        $viewvCard_templateModel = new vCard_templateModel();
        $getallvcard = $viewvCard_templateModel->latest('created_at', 'asc')->where('Vtable_status', '0')->get();

        $viewvCard_templateModel = new vCard_templateModel();
        $templateNames = ['vcard1', 'vcard2', 'vcard3', 'vcard4', 'vcard5', 'vcard6', 'vcard7', 'vcard8', 'vcard9', 'vcard10'];
        $vCounts = [];

        foreach ($templateNames as $index => $templateName) {
            $vCard = $viewvCard_templateModel->where('template_name', $templateName)->first();

            if ($vCard) {
                $vCardId = $vCard->id;
                $matchedVCard = vcardAddModel::where('vcard_id', $vCardId)->get();
                $vCounts["v" . ($index + 1)] = $matchedVCard->count();
            } else {
                $vCounts["v" . ($index + 1)] = 0;
            }
        }


        return view('admin.vcardTemplate.vcardTemplate', ['vCounts' => $vCounts, 'sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
    }
    public function addformvCardTemplate(Request $request)
    {
        try {
            $vcard_name = $request->input('template_name');
            $vcard_url = $request->input('template_url');
            $vCard_templateModel = new vCard_templateModel();

            $checkalreadyname = $vCard_templateModel->where('template_name', $vcard_name)->first();

            if ($checkalreadyname) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Template name already addedd.',
                ]);
            }


            if ($request->hasFile('template_photo')) {
                $vcard_pic = $request->file('template_photo');

                $mime = $vcard_pic->getMimeType();
                // Log::info("Detected MIME type: $mime");

                if ($vcard_pic->isValid() && Str::startsWith($mime, 'image/png')) {
                    $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
                    $originalFilename = $vcard_pic->getClientOriginalName();
                    $pathinfo = pathinfo($originalFilename);
                    $fileExtension = strtolower($pathinfo['extension']);
                    if (in_array($fileExtension, $allowedExtensions)) {
                        $destinationPath = 'admin/uploads/users';
                        $vcardimage = rand(0000, 9999) . $originalFilename;
                        $vcard_pic->move($destinationPath, $vcardimage);

                        $data = [
                            'template_name' => $vcard_name,
                            'template_url' => $vcard_url,
                            'template_photo' => $vcardimage,
                        ];

                        $vCard_templateModel->create($data);

                        return response()->json([
                            'status' => 200,
                            'message' => 'Template added successfully.',
                        ]);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'message' => 'Invalid file format. Please upload a valid image file (jpeg, jpg, png, gif).',
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Invalid file. Please upload a valid image file.',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No file uploaded.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function vcard1()
    {
        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];

        return view('admin.vcardTemplate.vCardTmp.vcard1', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }
    public function vcard2()
    {
        $qrcode = 'NA';

        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard2', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }
    public function vcard3()
    {
        $qrcode = 'NA';

        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard3', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }

    public function vcard4()
    {
        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard4', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }

    public function vcard5()
    {

        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard5', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }

    public function vcard6()
    {
        $qrcode = 'NA';

        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard6', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }
    public function vcard7()
    {
        $qrcode = 'NA';

        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard7', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }
    public function vcard8()
    {
        $qrcode = 'NA';

        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard8', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }
    public function vcard9()
    {
        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard9', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }

    public function vcard10()
    {
        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard10', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }

    public function vcard11()
    {
        $qrcode = 'NA';
        $getuser = (object)[
            'name'  => 'NA',
            'email' => 'NA'
        ];
        return view('admin.vcardTemplate.vCardTmp.vcard11', ['getuser' => $getuser, 'qrcode' => $qrcode]);
    }


    public function addvcard()
    {
        try {
            if (!Session::has('userId')) {
                return redirect()->route('login');
            }
            $vCard_templateModel = new vCard_templateModel();
            $getselect = $vCard_templateModel->get();
            $usermodel = new userModel();
            $getuser = $usermodel->where('table_status', '0')->get();
            $sessionName = Session::get('name');
            $sessionEmail = Session::get('email');
            return view('admin.vcard.addvcard', ['getselect' => $getselect, 'getuser' => $getuser, 'sessionName' => $sessionName, 'sessionEmail' => $sessionEmail]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function addformVcard(Request $request)
    {
        try {
            $vcard_id = $request->input('vcard_id');
            $userid = $request->input('userid');
            // $nfcid = $request->input('nfc_id');

            $vcard_status = $request->input('vcard_status');
            $strVcardId = (string) $vcard_id;
            // $nfcid = (string) $nfcid;
            $vcard_status = (string) $vcard_status;

            if (empty($strVcardId)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard id not found',
                ]);
            }

            // if (empty($nfcid)) {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'nfcid not found',


            //     ]);
            // }
            if (empty($vcard_status)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'select vcard_status',
                ]);
            }
            // $getvcardpng = vcardAddModel::where('vcard_id', $vcard_id)
            //     ->where('userid', $userid)
            //     ->first();

            $getvcardpng = vcardAddModel::where('userid', $userid)->first();

            if ($getvcardpng) {
                $getpngqrcodefile = url('qr_codes/' . $getvcardpng->qr_code);

                return response()->json([
                    'status' => 404,
                    'message' => 'User already Added.',
                    'data' => $getpngqrcodefile
                ]);
            } else {
                $data = [
                    'vcard_id' => $vcard_id,
                    'userid' => $userid,
                    // 'nfc_id' => $nfcid,
                    'vcard_status' => $vcard_status,

                ];

                // $mergedImagePath = public_path('vCard-1.png');

                // $qrcode = QrCode::format('png')
                //     ->merge($mergedImagePath, .20, true)
                //     ->errorCorrection('H')
                //     ->size(300)
                //     ->generate(json_encode($data));


                $from = [255, 0, 0];
                $to = [0, 0, 255];
                $qrcode = QrCode::format('png')
                    ->style('dot')
                    ->eye('circle')
                    ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                    ->margin(1)
                    ->generate(json_encode($data));

                $directory = public_path('qr_codes');

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                $timestamp = now()->timestamp;
                $filename = 'generated_qr_code_' . $timestamp . '.png';
                $filePath = $directory . DIRECTORY_SEPARATOR . $filename;

                file_put_contents($filePath, $qrcode);

                $imageURL = asset('qr_codes/' . $filename);

                $dataall = vcardAddModel::create([
                    'vcard_id' => $vcard_id,
                    'userid' => $userid,
                    // 'nfc_id' => $nfcid,
                    'vcard_status' => $vcard_status,
                    'qr_code' => $filename
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Vcard added successfully.',
                    'image_url' => $dataall
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

    public function geturlid($id)
    {

        try {
            $vcardAddModel = new vcardAddModel();

            $vcardAddModeldata = $vcardAddModel->where('id', $id)->first();

            $getuserid = $vcardAddModeldata->vcard_id;

            $userid = $vcardAddModeldata->userid;

            $getuser = userModel::where('id', $userid)->first();

            $gettempcardmodel = new vCard_templateModel();

            $getcard = $gettempcardmodel->where('id', $getuserid)->first();

            if ($getcard) {
                $gettempname = $getcard->template_name;

                if ($gettempname === 'vcard1') {
                    // $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                    // $domain = $protocol . $_SERVER['HTTP_HOST'];
                    // $domain = strval($domain);
                    // $url = $domain == 'http://localhost' ? 'http://192.168.0.24' : 'http://192.168.0.24/' . 'geturlid/' . $id;
                    // return $url;

                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();

                    return view('admin.vcardTemplate.vCardTmp.vcard1', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard2') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];
                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();

                    return view('admin.vcardTemplate.vCardTmp.vcard2', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard3') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;

                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard3', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard4') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard4', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard5') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard5', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard6') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];
                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;

                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard6', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard7') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];
                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;

                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard7', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard8') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard8', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard9') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;

                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard9', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard10') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;

                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard10', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } elseif ($gettempname === 'vcard11') {
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                    $currentPort = $_SERVER['SERVER_PORT'];
                    $host =  getHostByName(getHostName());
                    // $url = $protocol . $host . '/geturlid/' . $id;
                    $url = $protocol . $host . ':' . $currentPort . '/geturlid/' . $id;
                    $from = [255, 0, 0];
                    $to = [0, 0, 255];

                    //add the url in qr code
                    // $userurl = $protocol . $host . ':' . $currentPort . '/vcardcheckUser/' . $userid;
                    // return $userurl;
                    $qrcodeFormat = QrCode::format('png')
                        ->style('dot')
                        ->eye('circle')
                        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
                        ->margin(1)
                        ->generate($url);
                    $directory = public_path('qr_codes');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }


                    $timestamp = now()->timestamp;
                    $filename = 'generated_qr_code_' . $timestamp . '.png';
                    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($filePath, $qrcodeFormat);
                    $imageURL = asset('qr_codes/' . $filename);
                    $vcardAddModel->where('id', $id)->update(['qr_code' => $filename]);

                    $qrcode = vcardAddModel::where('id', $id)->pluck('qr_code')->first();
                    return view('admin.vcardTemplate.vCardTmp.vcard11', ['getuser' => $getuser, 'qrcode' => $qrcode]);
                } else {
                    return view('Not found');
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
