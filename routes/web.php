<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use App\Http\Controllers\vcardController;
use App\Http\Controllers\nfsController;
use App\Http\Controllers\vcardTemplateController;
use App\Http\Controllers\plainController;
use App\Http\Controllers\affiliationsController;
use App\Http\Controllers\frontCMSController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\vcardEmailController;
use App\Http\Controllers\PhonePeController;
use App\Http\Controllers\PhonepayController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ScanQrCodeController;

Route::post('login', [LoginController::class, 'customLogin'])->name('login.post');
Route::post('register', [LoginController::class, 'customRegister'])->name('register.post');


//vcard login and register
Route::post('vcardlogin/{id}', [LoginController::class, 'vcardLogin'])->name('vcardLogin.post');
Route::post('vcardregister/{nfcid}', [LoginController::class, 'vcardRegistger'])->name('vcardRegistger.post');


Route::post('role', [roleController::class, 'role'])->name('role.post');
Route::post('addFormPermission', [PermissionController::class, 'addFormPermission'])->name('addFormPermission.post');
Route::post('permissionToggle', [PermissionController::class, 'permissionToggle'])->name('permissionToggle.post');
Route::get('getFormPermission/{id}', [PermissionController::class, 'getFormPermission'])->name('getFormPermission.post');
Route::post('EditFormPermission/{id}', [PermissionController::class, 'EditFormPermission'])->name('EditFormPermission.post');
Route::post('deletePermission/{id}', [PermissionController::class, 'deletePermission'])->name('deletePermission.post');
Route::post('addFormRole', [roleController::class, 'addformRole'])->name('addformRole.post');

Route::post('roleTogglePermission', [roleController::class, 'roleToggle'])->name('roleTogglePermission.post');
Route::post('EditFormRole/{id}', [roleController::class, 'EditFormRole'])->name('EditFormRole.post');

//Add form users
Route::post('addFormUsers', [userController::class, 'AddFormUsers'])->name('AddFormUsers.post');
Route::post('userToggleStatus', [userController::class, 'userStatusToggle'])->name('userStatusToggle.post');

Route::post('editFormUser/{id}', [userController::class, 'editFormUser'])->name('editFormUser.post');
Route::post('editPassword/{id}', [userController::class, 'editPassword'])->name('editPassword.post');

Route::post('userDelete/{id}', [userController::class, 'userDelete'])->name('userDelete.post');
Route::post('addformvCardTemplate', [vcardTemplateController::class, 'addformvCardTemplate'])->name('addvCardTemplate.post');

Route::post('addformVcard', [vcardTemplateController::class, 'addformVcard'])->name('addformVcard.post');
Route::post('editRoleButtonValue/{id}', [roleController::class, 'editRoleButtonValue'])->name('editRoleButtonValue.post');

Route::post('roleDelete/{id}', [roleController::class, 'roleDelete'])->name('roleDelete.post');
Route::post('editvcard/{id}', [vcardController::class, 'editVcard'])->name('editvcard.post');

Route::post('vcardUpdate/{id}', [vcardController::class, 'vcardUpdate'])->name('vcardUpdate.post');

Route::post('deleteVcard/{id}', [vcardController::class, 'deleteVcard'])->name('deleteVcard.post');

// vcardEmailController
Route::post('AddFormVcardEmail/{fromEmail}', [vcardEmailController::class, 'AddFormVcardEmail'])->name('AddFormVcardEmail.post');


Route::get('paymentInit', [PhonePeController::class, 'makePhonePePayment']);
Route::post('phonepe.payment.callback', [PhonePeController::class, 'phonePeCallback'])->name('phonepe.payment.callback');


// Route::get('pay', [PhonepayController::class, 'payment_init']);
// Route::get('pay-refund-view', [PhonepayController::class, 'refund']);
// Route::get('pay-refund', [PhonepayController::class, 'payment_refund']);
// Route::any('pay-return-url', [PhonepayController::class, 'payment_return'])->name('pay-return-url');
// Route::post('pay-callback-url', [PhonepayController::class, 'payment_callback'])->name('pay-callback-url');
// Route::any('pay-refund-callback', [PhonepayController::class, 'payment_refund_callback'])->name('pay-refund-callback');



Route::get('/', function (Request $request) {
    if ($request->session()->get('userId')) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});


Route::group(['middleware' => 'prevent-back-history', 'auth'], function () {
    Route::get('setting', [settingController::class, 'setting'])->name('setting');
    Route::get('frontCMS', [frontCMSController::class, 'frontCMS'])->name('frontCMS');
    Route::get('affiliations', [affiliationsController::class, 'affiliations'])->name('affiliations');
    Route::get('plain', [plainController::class, 'plain'])->name('plain');
    Route::get('vcardTemplate', [vcardTemplateController::class, 'vcardTemplate'])->name('vcardTemplate')->middleware('checkRouteAccess');
    Route::get('nfs', [nfsController::class, 'nfs'])->name('nfs');
    Route::get('vcard', [vcardController::class, 'vcard'])->name('vcard')->middleware('checkRouteAccess');
    Route::get('user', [userController::class, 'user'])->name('user')->middleware('checkRouteAccess');
    Route::get('adminPage', [adminController::class, 'adminPage'])->name('adminPage');
    Route::get('role', [roleController::class, 'role'])->name('role')->middleware('checkRouteAccess');

    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    //permission
    Route::get('permission', [PermissionController::class, 'permissionView'])->name('permission')->middleware('checkRouteAccess');
    Route::get('addPermission', [PermissionController::class, 'addPermission'])->name('addPermission')->middleware('checkRouteAccess');

    //Role
    Route::get('addRole', [roleController::class, 'addRole'])->name('addRole')->middleware('checkRouteAccess');
    Route::get('editRole/{id}', [roleController::class, 'editRole'])->name('editRoleForm');

    Route::get('adduser', [userController::class, 'adduser'])->name('adduser')->middleware('checkRouteAccess');
    Route::get('editUser/{id}', [userController::class, 'editUser'])->name('editUser')->middleware('checkRouteAccess');

    Route::get('vCardTemplate', [vcardTemplateController::class, 'AddvCardTemplate'])->name('vCardTemplate');



    Route::get("addvcard", [VcardTemplateController::class, 'addvcard'])->name("addvcard");
});

Route::get("geturlid/{id}", [VcardTemplateController::class, 'geturlid'])->name("geturlid");
Route::get("vcard1", [VcardTemplateController::class, 'vcard1'])->name("vcard1");
Route::get("vcard2", [VcardTemplateController::class, 'vcard2'])->name("vcard2");
Route::get("vcard3", [VcardTemplateController::class, 'vcard3'])->name("vcard3");
Route::get("vcard4", [VcardTemplateController::class, 'vcard4'])->name("vcard4");
Route::get("vcard5", [VcardTemplateController::class, 'vcard5'])->name("vcard5");
Route::get("vcard6", [VcardTemplateController::class, 'vcard6'])->name("vcard6");
Route::get("vcard7", [VcardTemplateController::class, 'vcard7'])->name("vcard7");
Route::get("vcard8", [VcardTemplateController::class, 'vcard8'])->name("vcard8");
Route::get("vcard9", [VcardTemplateController::class, 'vcard9'])->name("vcard9");
Route::get("vcard10", [VcardTemplateController::class, 'vcard10'])->name("vcard10");
Route::get("vcard11", [VcardTemplateController::class, 'vcard11'])->name("vcard11");
Route::get('test', fn () => phpinfo());

//vcard dashboard
Route::group(['middleware' => 'vcardBackMiddleware', 'auth'], function () {
    Route::get('vcardEdit', [LoginController::class, 'vcardEdit'])->name('vcardEdit');
    Route::get('vcard-login/{id}', function ($id) {
        $sessiongetid = Session::get('userId', $id);
        return view('admin.vcardloginRegister.vcardlogin', ['sessiongetid' => $sessiongetid]);
    })->name('vcardlogin');
});

Route::get('vcard_dashboard', [LoginController::class, 'vcard_dashboard'])->name('vcard_dashboard');

Route::get('login', function () {
    return view('admin.login');
})->name('login');

Route::get('v-card_register', function () {
    return view('admin.register');
})->name('register');

Route::get('vcardcheckUser/{nfcid}', [LoginController::class, 'vcardcheckUser'])->name('vcardTemplateDummy');
Route::get('vcard-register/{nfcid}', function ($nfcid) {

    return view('admin.vcardloginRegister.vcardregister', ['nfcid' => $nfcid]);
})->name('vcardregister');


Route::post('editcardDetails', [LoginController::class, 'editcardDetails'])->name('editcardDetails.post');

Route::post('addToContact/{id}', [ScanQrCodeController::class, 'addToContact'])->name('addToContact');


Route::get('viewQrcodeTapCard', [LoginController::class, 'viewQrcodeTapCard']);
Route::post('createQrcodeTapCard', [LoginController::class, 'createQrcodeTapCard'])->name('createQrcodeTapCard.post');
