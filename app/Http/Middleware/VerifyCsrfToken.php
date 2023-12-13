<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login/',
        'register/',
        'addFormPermission/',
        'permissionToggle/',
        'EditFormPermission/*',
        'getFormPermission/*',
        'editpermiissionid/*',
        'deletePermission/*',
        'addFormRole/',
        'roleTogglePermission/',
        'EditFormRole/*',
        'addFormUsers',
        'userToggleStatus',
        'editFormUser/*',
        'editPassword/*',
        'userDelete/*',
        'addformvCardTemplate',
        'addformVcard',
        'editRoleButtonValue/*',
        'roleDelete/*',
        'editvcard/*',
        'vcardUpdate/*',
        'phonepe.payment.callback',
        'AddFormVcardEmail/*',
        'vcardlogin/*',
        'vcardregister/*',
        'editcardDetails',
        'addToContact/*',
        'createQrcodeTapCard'
    ];
}
