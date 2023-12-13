<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\vcardAddModel;
use App\Models\vCard_templateModel;

class vcardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('userId')) {
                $this->session($request);
            } elseif ($request->route()->getActionMethod() !== 'editVcard' && $request->route()->getActionMethod() !== 'vcardUpdate') {
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

    public function vcard(Request $request)
    {
        try {
            $vcardAddModel = new vcardAddModel();
            $getvcardmodel = $vcardAddModel->latest('created_at', 'asc')
                ->where('vcard_status', 'active')
                ->where('table_status', '0')
                ->get();

            $vcardtemp = new vCard_templateModel();
            $vcardTemplateIds = $vcardtemp->pluck('id')->toArray();
            $values = [];
            foreach ($getvcardmodel as $value) {
                $values[] = $value->vcard_id;
            }
            $matchingIds = array_intersect($values, $vcardTemplateIds);
            if (!empty($matchingIds)) {
                $matchedData = $vcardtemp->whereIn('id', $matchingIds)->get(['id', 'template_name', 'template_photo']);
                $matchedResults = [];
                foreach ($matchedData as $data) {
                    $matchedResults[$data->id] = [
                        'template_name' => $data->template_name,
                        'template_photo' => $data->template_photo,
                    ];
                }
                $getusermodel = new userModel();
                $getvcartemp = $vcardtemp->get();
                $getuserdata = $getusermodel->where('table_status', '0')->get();
                // return $getuserdata;
                return view('admin.vcard.vcard', ['getuserdata' => $getuserdata, 'getvcartemp' => $getvcartemp, 'getvcardmodel' => $getvcardmodel, 'matchedResults' => $matchedResults]);
            } else {
                return view('admin.vcard.vcard', ['getvcardmodel' => $getvcardmodel]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function editVcard($id)
    {
        try {

            if (empty($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'id not found',
                ]);
            }

            $getaddvcard = vcardAddModel::where('id', $id)->first();
            if ($getaddvcard) {
                $vcard_id = $getaddvcard->vcard_id;
                $userid = $getaddvcard->usermodel->id;

                // Convert $userid to a string
                $getuserid = (string) $userid;

                $username = $getaddvcard->usermodel->name;
                $vcardname = $getaddvcard->vcardTemplateModel->template_name;
                $data = [
                    'id' => $id,
                    'user_id' => $getuserid ?? null,
                    'name' => $username ?? null,
                    'vcard_id' => $vcard_id ?? null,
                    'vcard_name' => $vcardname ?? null,
                    'vcard_status' => $getaddvcard->vcard_status ?? null,
                ];
                return response()->json([
                    'status' => 200,
                    'message' => 'Vcard Details',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard not found',
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

    public function vcardUpdate(Request $request, $id)
    {
        try {

            if (empty($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard not found',
                ]);
            }
            $vcard_id = $request->input('vcard_id');
            $userid = $request->input('userid');

            if (empty($vcard_id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard id not found',
                ]);
            }
            if (empty($userid)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'userid not found',
                ]);
            }

            $data = [
                'vcard_id' => $vcard_id,
                'userid' => $userid,

            ];

            $vcardAddModel = new vcardAddModel();
            $getaddcard = $vcardAddModel->where('id', $id)->update($data);
            if ($getaddcard > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'vcard updated successfully',
                    'redirect' => url('vcard')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard not updated',
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

    public function deleteVcard($id)
    {
        try {

            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter valid id.'
                ]);
            }

            if (!$id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter id.'
                ]);
            }

            $vaddcard = new vcardAddModel();

            $findid = $vaddcard->where('id', $id)->first();
            if (!$findid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id not found.'
                ]);
            }

            $deleteId = $vaddcard->where('id', $id)->delete();

            if ($deleteId) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Vcard deleted',
                    'redirect' => url('vcard')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'vcard not deleted',
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
