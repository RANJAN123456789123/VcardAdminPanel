<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\permisionModel;
use GuzzleHttp\Psr7\Response;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('userId')) {
                $this->session($request);
            }

            // Add an explicit check for the addFormPermission route here
            elseif ($request->route()->getActionMethod() !== 'addFormPermission' && $request->route()->getActionMethod() !== 'permissionToggle' && $request->route()->getActionMethod() !== 'EditFormPermission' && $request->route()->getActionMethod() !== 'getFormPermission' && $request->route()->getActionMethod() !== 'deletePermission') {
                return redirect()->route('login');
            }

            return $next($request);
        });
    }

    private function session(Request $request)
    {
        $sessionName = Session::get('name');
        $sessionEmail = Session::get('email');
        view()->share('sessionName', $sessionName);
        view()->share('sessionEmail', $sessionEmail);
    }

    public function permissionView(Request $request)
    {
        $permisionalldata = new permisionModel();

        $permisonview = $permisionalldata->latest('created_at', 'asc')->get();

        return view('admin.permission.permission', ['permisonview' => $permisonview]);
    }

    public function addPermission(Request $request)
    {
        return view('admin.permission.addPermission');
    }


    public function addFormPermission(Request $request)
    {
        try {
            $moduleFeaturename = $request->input('module_feature_name');
            $permission_name = $request->input('permission_name');
            $permission_status = $request->input('permission_status');
            $permissionmodel = new permisionModel();

            $moduleandpermissionname = $permissionmodel->where('module_feature_name', $moduleFeaturename)->where('permission_name', $permission_name)->first();

            // print_r($moduleandpermissionname);exit;

            if ($moduleandpermissionname) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Module And Permission Already Exists',
                ]);
            }
            $datacreate = [
                'module_feature_name' => $moduleFeaturename,
                'permission_name' => $permission_name,
                'permission_status' => $permission_status

            ];
            $datacreate =  $permissionmodel->create($datacreate);
            // return $datacreate;
            if ($datacreate) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Permission Created Successfully',
                    'permissionData' => $datacreate
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission Created failed',

                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),

            ]);
        }
    }


    public function permissionToggle(Request $request)
    {
        try {

            $permission_id = $request->input('id');
            $permission = $request->input('permission_status');

            $permissionmodel = new permisionModel();

            $checkid = $permissionmodel->where('id', $permission_id)->first();

            if (!is_numeric($permission_id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission id is not a valid integer',
                ]);
            }

            if (!$checkid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission id not found',
                ]);
            }

            $updatePermissionToggleStatus = $permissionmodel->where('id', $permission_id)->update(['permission_status' => $permission]);

            if ($updatePermissionToggleStatus > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Permission Changed Success'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'permission status failed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public  function EditFormPermission(Request $request, $id)
    {
        try {
            // $id = $request->input('id');
            $moduleFeaturename = $request->input('module_feature_name');
            $permission_name = $request->input('permission_name');
            $permissionmodel = new permisionModel();

            $checkid = $permissionmodel->where('id', $id)->first();

            if (!$moduleFeaturename) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Select module feature',
                ]);
            }

            if (!$permission_name) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Select pemission',
                ]);
            }


            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission id is not a valid integer',
                ]);
            }

            if (!$checkid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission id not found',
                ]);
            }

            $alreadyData = $permissionmodel->where('id', $id)
                ->where('module_feature_name', $moduleFeaturename)
                ->where('permission_name', $permission_name)
                ->first();

            if ($alreadyData) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Module feature and permission name already exist',
                ]);
            }


            $updatePermissionToggleStatus = $permissionmodel->where('id', $id)->update(['module_feature_name' => $moduleFeaturename, 'permission_name' => $permission_name]);

            if ($updatePermissionToggleStatus > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Permission Updated Success',
                    'redirect' => url('permission')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'permission Updated failed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function getFormPermission($id)
    {
        try {

            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission id is not a valid integer',
                ]);
            }
            $permissionmodel = new permisionModel();
            $checkid = $permissionmodel->where('id', $id)->first();
            if ($checkid) {
                return response()->json([
                    'status' => 200,
                    'message' => 'permission id found',
                    'data' => $checkid
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'permission id not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function deletePermission($id)
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


            $permission = new permisionModel();

            $findid = $permission->where('id', $id)->first();
            if (!$findid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id not found.'
                ]);
            }

            $deletePermissionId = $permission->where('id', $id)->delete();

            if ($deletePermissionId) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Permission deleted',
                    'redirect' => url('permission')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Permission not deleted',
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
