<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\permisionModel;
use Illuminate\Support\Facades\Session;
use App\Helpers\permissionButtonAccessHelper;
use Illuminate\Support\Facades\View;
use App\Models\roleModel;

class roleController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Session::has('userId')) {
                $this->session($request);
            }
            // Add an explicit check for the addFormPermission route here
            elseif ($request->route()->getActionMethod() !== 'adminCreate' && $request->route()->getActionMethod() !== 'addformRole' && $request->route()->getActionMethod() !== 'roleToggle' && $request->route()->getActionMethod() !== 'EditFormRole' && $request->route()->getActionMethod() !== 'editRoleButtonValue' && $request->route()->getActionMethod() !== 'roleDelete') {
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

    public function role(Request $request)
    {
        $getAll = new roleModel();
        $getallrole = $getAll->latest('created_at', 'asc')->where('table_status', '0')->get();

        return view('admin.role.role', ['getallrole' => $getallrole]);
    }

    public function addRole(Request $request)
    {
        try {
            return View::make('admin.role.addrole');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function addformRole(Request $request)
    {
        try {
            $fields = [
                'role_name',
                'admin_create',
                'admin_edit',
                'admin_show',
                'admin_delete',
                'user_create',
                'user_edit',
                'user_show',
                'user_delete',
                'permission_create',
                'permission_edit',
                'permission_show',
                'permission_delete',
                'role_create',
                'role_edit',
                'role_show',
                'role_delete',
                'role_status',
                'vcard_create',
                'vcard_edit',
                'vcard_show',
                'vcard_delete',
                'vcardtemplate_create',
                'vcardtemplate_edit',
                'vcardtemplate_show',
                'vcardtemplate_delete'
            ];

            $getall = $request->only($fields);


            if (!isset($getall['admin_create'])) {
                $getall['admin_create'] = 'inactive';
            }

            if (!isset($getall['admin_edit'])) {
                $getall['admin_edit'] = 'inactive';
            }

            if (empty($getall['role_name'])) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter role name'
                ]);
            }

            $rolemodel = new RoleModel();
            $checkrolename = $rolemodel->where('role_name', $getall['role_name'])->first();
            if ($checkrolename) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role name already exists'
                ]);
            }

            $addallroledata = $rolemodel->create($getall);

            if ($addallroledata) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Role Added',
                    'data' => $addallroledata
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role not added'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function editRole($id)
    {
        $rolemodel = new roleModel();

        $editrole = $rolemodel->where('id', $id)->first();

        // return $editrole;
        return view('admin.role.EditRole', ['editrole' => $editrole]);
    }

    public function roleToggle(Request $request)
    {
        try {
            $role_id = $request->input('id');
            $role_status = $request->input('role_status');

            if (!is_numeric($role_id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role id is not a valid integer',
                ]);
            }

            $roleModel = new roleModel(); // Assuming the class name is RoleModel

            $checkid = $roleModel->where('id', $role_id)->first();

            if (!$checkid) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role id not found',
                ]);
            }

            $updateRoleToggleStatus = $roleModel->where('id', $role_id)->update(['role_status' => $role_status]);
            // return $updateRoleToggleStatus;
            if ($updateRoleToggleStatus > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Role Changed Success'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role status failed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function EditFormRole(Request $request, $id)
    {
        try {
            $fields = [
                'role_name',
                'admin_create',
                'admin_edit',
                'admin_show',
                'admin_delete',
                'user_create',
                'user_edit',
                'user_show',
                'user_delete',
                'permission_create',
                'permission_edit',
                'permission_show',
                'permission_delete',
                'role_create',
                'role_edit',
                'role_show',
                'role_delete',
                'role_status',
                'vcard_create',
                'vcard_edit',
                'vcard_show',
                'vcard_delete',
                'vcardtemplate_create',
                'vcardtemplate_edit',
                'vcardtemplate_show',
                'vcardtemplate_delete'
            ];

            $getall = $request->only($fields);

            if (empty($getall['role_name'])) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Enter role name'
                ]);
            }

            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role id is not a valid integer',
                ]);
            }

            $rolemodel = roleModel::where('id', $id)->first();

            if (!$rolemodel) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role id not found',
                ]);
            }

            $checkrolename = RoleModel::where('role_name', $getall['role_name'])
                ->where('id', '!=', $id)
                ->first();

            if ($checkrolename) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role name already exists'
                ]);
            }

            $updateroledata = $rolemodel->update([
                'role_name' => $getall['role_name'],
                'admin_create' => $getall['admin_create'],
                'admin_edit' => $getall['admin_edit'],
                'admin_show' => $getall['admin_show'],
                'admin_delete' => $getall['admin_delete'],
                'user_create' => $getall['user_create'],
                'user_edit' => $getall['user_edit'],
                'user_show' => $getall['user_show'],
                'user_delete' => $getall['user_delete'],
                'permission_create' => $getall['permission_create'],
                'permission_edit' => $getall['permission_edit'],
                'permission_show' => $getall['permission_show'],
                'permission_delete' => $getall['permission_delete'],
                'role_create' => $getall['role_create'],
                'role_edit' => $getall['role_edit'],
                'role_show' => $getall['role_show'],
                'role_delete' => $getall['role_delete'],
                'vcard_create' => $getall['vcard_create'],
                'vcard_edit' => $getall['vcard_edit'],
                'vcard_show' => $getall['vcard_show'],
                'vcard_delete' => $getall['vcard_delete'],
                'vcardtemplate_create' => $getall['vcardtemplate_create'],
                'vcardtemplate_edit' => $getall['vcardtemplate_edit'],
                'vcardtemplate_show' => $getall['vcardtemplate_show'],
                'vcardtemplate_delete' => $getall['vcardtemplate_delete'],
                'role_status' => $getall['role_status']
            ]);
            if ($updateroledata > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Role updated',
                    'data' => $rolemodel
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Role updated failed',

                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function editRoleButtonValue($id)
    {
        try {

            $rolemodel =  roleModel::where('id', $id)->first();


            if ($rolemodel) {
                return response()->json([
                    'status' => 200,
                    'message' => 'data found',
                    'data' => $rolemodel

                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'id not found',

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

    public function roleDelete($id)
    {
        try {

            if (!is_numeric($id)) {
                return response()->json([
                    'status' => 404,
                    'message' => 'id is not integer',
                ]);
            }

            $delete = roleModel::where('id', $id)->delete();

            if ($delete > 0) {
                return response()->json([
                    'status' => 200,
                    'message' => 'role deleted successfully',
                    'redirect' => url('role')
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'role not deleted',
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
