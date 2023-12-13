<style>
    .collapse-item {
        display: inline-block;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        text-decoration: none;
        color: #4a5568;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .collapse-item.active {
        background-color: #d5dfd5;
        color: #0c0b0b;
        border-color: #4CAF50;
    }

    .collapse-item:hover {
        background-color: #f7fafc;
        color: #2d3748;
        border-color: #090b0c;
    }
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">V-CARD</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">Expand List</a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @php
                    $adminPermission = $allButtonAccessHelper->checkPermissionForAction($request, 'show');
                    $userPermission = $allButtonAccessHelper->checkPermissionForActionUser($request, 'show');
                    $rolePermission = $allButtonAccessHelper->checkPermissionForActionRole($request, 'show');
                    $PerPermission = $allButtonAccessHelper->checkPermissionForActionPermission($request, 'show');
                    $showVcard = $allButtonAccessHelper->checkPermissionForActionVcard($request, 'show');
                    $showUserVcardTemp = $allButtonAccessHelper->checkPermissionForActionVcardTemp($request, 'show');
                @endphp

                {{-- @if ($adminPermission === 'active')
                    <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/adminPage' ? 'active' : ''; ?>" href="{{ route('adminPage') }}"><svg
                            class="svg-inline--fa fa-house-user" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="house-user" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512" data-fa-i2svg="" width="16" height="16">
                            <path fill="currentColor"
                                d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.6 483.2 483.9 512 448.5 512H128.1C92.75 512 64.09 483.3 64.09 448V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5H575.8zM288 160C252.7 160 224 188.7 224 224C224 259.3 252.7 288 288 288C323.3 288 352 259.3 352 224C352 188.7 323.3 160 288 160zM256 320C211.8 320 176 355.8 176 400C176 408.8 183.2 416 192 416H384C392.8 416 400 408.8 400 400C400 355.8 364.2 320 320 320H256z">
                            </path>
                        </svg>&nbsp;Admin</a>
                @endif --}}


                @if ($userPermission === 'active')
                    <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/user' ? 'active' : ''; ?>" href="{{ route('user') }}"><i
                            class="fas fa-users"></i>&nbsp;User</a>
                @endif

                @if ($showVcard === 'active')
                    <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/vcard' ? 'active' : ''; ?>" href="{{ route('vcard') }}"> <svg class="svg-inline--fa fa-table-columns" aria-hidden="true"
                        focusable="false" data-prefix="fas" data-icon="table-columns" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""width="16" height="16">
                        <path fill="currentColor"
                            d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 416H224V160H64V416zM448 160H288V416H448V160z">
                        </path>
                    </svg>&nbsp;Vcard</a>
                @endif


                {{-- <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/nfs' ? 'active' : ''; ?>" href="{{ route('nfs') }}"><i
                        class="fa fa-address-card"></i>&nbsp;NFS</a> --}}

                @if ($showUserVcardTemp === 'active')
                    <a class="collapse-item  <?php echo $_SERVER['REQUEST_URI'] === '/vcardTemplate' ? 'active' : ''; ?>" href="{{ route('vcardTemplate') }}"><svg
                            class="svg-inline--fa fa-id-card-clip" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="id-card-clip" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512" data-fa-i2svg="" width="16" height="16">
                            <path fill="currentColor"
                                d="M256 128h64c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32H256C238.3 0 224 14.33 224 32v64C224 113.7 238.3 128 256 128zM528 64H384v48C384 138.5 362.5 160 336 160h-96C213.5 160 192 138.5 192 112V64H48C21.49 64 0 85.49 0 112v352C0 490.5 21.49 512 48 512h480c26.51 0 48-21.49 48-48v-352C576 85.49 554.5 64 528 64zM288 224c35.35 0 64 28.66 64 64s-28.65 64-64 64s-64-28.66-64-64S252.7 224 288 224zM384 448H192c-8.836 0-16-7.164-16-16C176 405.5 197.5 384 224 384h128c26.51 0 48 21.49 48 48C400 440.8 392.8 448 384 448z">
                            </path>
                        </svg>&nbsp;vCard Template</a>
                @endif

                {{-- <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/plain' ? 'active' : ''; ?>" href="{{ route('plain') }}"><svg
                        class="svg-inline--fa fa-table-columns" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="table-columns" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512" data-fa-i2svg="" width="16" height="16">
                        <path fill="currentColor"
                            d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 416H224V160H64V416zM448 160H288V416H448V160z">
                        </path>
                    </svg>&nbsp;Plans</a>
                <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/affiliations' ? 'active' : ''; ?>" href="{{ route('affiliations') }}">
                    <svg class="svg-inline--fa fa-coins" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="coins" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        data-fa-i2svg="" width="16" height="16">
                        <path fill="currentColor"
                            d="M512 80C512 98.01 497.7 114.6 473.6 128C444.5 144.1 401.2 155.5 351.3 158.9C347.7 157.2 343.9 155.5 340.1 153.9C300.6 137.4 248.2 128 192 128C183.7 128 175.6 128.2 167.5 128.6L166.4 128C142.3 114.6 128 98.01 128 80C128 35.82 213.1 0 320 0C426 0 512 35.82 512 80V80zM160.7 161.1C170.9 160.4 181.3 160 192 160C254.2 160 309.4 172.3 344.5 191.4C369.3 204.9 384 221.7 384 240C384 243.1 383.3 247.9 381.9 251.7C377.3 264.9 364.1 277 346.9 287.3C346.9 287.3 346.9 287.3 346.9 287.3C346.8 287.3 346.6 287.4 346.5 287.5L346.5 287.5C346.2 287.7 345.9 287.8 345.6 288C310.6 307.4 254.8 320 192 320C132.4 320 79.06 308.7 43.84 290.9C41.97 289.9 40.15 288.1 38.39 288C14.28 274.6 0 258 0 240C0 205.2 53.43 175.5 128 164.6C138.5 163 149.4 161.8 160.7 161.1L160.7 161.1zM391.9 186.6C420.2 182.2 446.1 175.2 468.1 166.1C484.4 159.3 499.5 150.9 512 140.6V176C512 195.3 495.5 213.1 468.2 226.9C453.5 234.3 435.8 240.5 415.8 245.3C415.9 243.6 416 241.8 416 240C416 218.1 405.4 200.1 391.9 186.6V186.6zM384 336C384 354 369.7 370.6 345.6 384C343.8 384.1 342 385.9 340.2 386.9C304.9 404.7 251.6 416 192 416C129.2 416 73.42 403.4 38.39 384C14.28 370.6 .0003 354 .0003 336V300.6C12.45 310.9 27.62 319.3 43.93 326.1C83.44 342.6 135.8 352 192 352C248.2 352 300.6 342.6 340.1 326.1C347.9 322.9 355.4 319.2 362.5 315.2C368.6 311.8 374.3 308 379.7 304C381.2 302.9 382.6 301.7 384 300.6L384 336zM416 278.1C434.1 273.1 452.5 268.6 468.1 262.1C484.4 255.3 499.5 246.9 512 236.6V272C512 282.5 507 293 497.1 302.9C480.8 319.2 452.1 332.6 415.8 341.3C415.9 339.6 416 337.8 416 336V278.1zM192 448C248.2 448 300.6 438.6 340.1 422.1C356.4 415.3 371.5 406.9 384 396.6V432C384 476.2 298 512 192 512C85.96 512 .0003 476.2 .0003 432V396.6C12.45 406.9 27.62 415.3 43.93 422.1C83.44 438.6 135.8 448 192 448z">
                        </path>
                    </svg>&nbsp;Affiliations</a>
                <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/frontCMS' ? 'active' : ''; ?>" href="{{ route('frontCMS') }}"><svg
                        class="svg-inline--fa fa-house" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="house" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                        data-fa-i2svg="" width="16" height="16">
                        <path fill="currentColor"
                            d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z">
                        </path>
                    </svg>&nbsp;Front CMS</a> --}}



                @if ($rolePermission === 'active')
                    <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/role' ? 'active' : ''; ?>" href="{{ route('role') }}"><i
                            class="fas fa-user"></i>&nbsp;Role</a>
                @endif


                @if ($PerPermission === 'active')
                    <a class="collapse-item  <?php echo $_SERVER['REQUEST_URI'] === '/permission' ? 'active' : ''; ?>" href="{{ route('permission') }}"><i
                            class="fa fa-key"></i>&nbsp;Permission</a>
                @endif
                {{-- <a class="collapse-item <?php echo $_SERVER['REQUEST_URI'] === '/setting' ? 'active' : ''; ?>" href="{{ route('setting') }}"><svg
                        class="svg-inline--fa fa-gears" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="gears" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                        data-fa-i2svg="" width="16" height="16">
                        <path fill="currentColor"
                            d="M286.3 155.1C287.4 161.9 288 168.9 288 175.1C288 183.1 287.4 190.1 286.3 196.9L308.5 216.7C315.5 223 318.4 232.1 314.7 241.7C312.4 246.1 309.9 252.2 307.1 257.2L304 262.6C300.1 267.6 297.7 272.4 294.2 277.1C288.5 284.7 278.5 287.2 269.5 284.2L241.2 274.9C230.5 283.8 218.3 290.9 205 295.9L198.1 324.9C197 334.2 189.8 341.6 180.4 342.8C173.7 343.6 166.9 344 160 344C153.1 344 146.3 343.6 139.6 342.8C130.2 341.6 122.1 334.2 121 324.9L114.1 295.9C101.7 290.9 89.5 283.8 78.75 274.9L50.53 284.2C41.54 287.2 31.52 284.7 25.82 277.1C22.28 272.4 18.98 267.5 15.94 262.5L12.92 257.2C10.13 252.2 7.592 247 5.324 241.7C1.62 232.1 4.458 223 11.52 216.7L33.7 196.9C32.58 190.1 31.1 183.1 31.1 175.1C31.1 168.9 32.58 161.9 33.7 155.1L11.52 135.3C4.458 128.1 1.62 119 5.324 110.3C7.592 104.1 10.13 99.79 12.91 94.76L15.95 89.51C18.98 84.46 22.28 79.58 25.82 74.89C31.52 67.34 41.54 64.83 50.53 67.79L78.75 77.09C89.5 68.25 101.7 61.13 114.1 56.15L121 27.08C122.1 17.8 130.2 10.37 139.6 9.231C146.3 8.418 153.1 8 160 8C166.9 8 173.7 8.418 180.4 9.23C189.8 10.37 197 17.8 198.1 27.08L205 56.15C218.3 61.13 230.5 68.25 241.2 77.09L269.5 67.79C278.5 64.83 288.5 67.34 294.2 74.89C297.7 79.56 300.1 84.42 304 89.44L307.1 94.83C309.9 99.84 312.4 105 314.7 110.3C318.4 119 315.5 128.1 308.5 135.3L286.3 155.1zM160 127.1C133.5 127.1 112 149.5 112 175.1C112 202.5 133.5 223.1 160 223.1C186.5 223.1 208 202.5 208 175.1C208 149.5 186.5 127.1 160 127.1zM484.9 478.3C478.1 479.4 471.1 480 464 480C456.9 480 449.9 479.4 443.1 478.3L423.3 500.5C416.1 507.5 407 510.4 398.3 506.7C393 504.4 387.8 501.9 382.8 499.1L377.4 496C372.4 492.1 367.6 489.7 362.9 486.2C355.3 480.5 352.8 470.5 355.8 461.5L365.1 433.2C356.2 422.5 349.1 410.3 344.1 397L315.1 390.1C305.8 389 298.4 381.8 297.2 372.4C296.4 365.7 296 358.9 296 352C296 345.1 296.4 338.3 297.2 331.6C298.4 322.2 305.8 314.1 315.1 313L344.1 306.1C349.1 293.7 356.2 281.5 365.1 270.8L355.8 242.5C352.8 233.5 355.3 223.5 362.9 217.8C367.6 214.3 372.5 210.1 377.5 207.9L382.8 204.9C387.8 202.1 392.1 199.6 398.3 197.3C407 193.6 416.1 196.5 423.3 203.5L443.1 225.7C449.9 224.6 456.9 224 464 224C471.1 224 478.1 224.6 484.9 225.7L504.7 203.5C511 196.5 520.1 193.6 529.7 197.3C535 199.6 540.2 202.1 545.2 204.9L550.5 207.9C555.5 210.1 560.4 214.3 565.1 217.8C572.7 223.5 575.2 233.5 572.2 242.5L562.9 270.8C571.8 281.5 578.9 293.7 583.9 306.1L612.9 313C622.2 314.1 629.6 322.2 630.8 331.6C631.6 338.3 632 345.1 632 352C632 358.9 631.6 365.7 630.8 372.4C629.6 381.8 622.2 389 612.9 390.1L583.9 397C578.9 410.3 571.8 422.5 562.9 433.2L572.2 461.5C575.2 470.5 572.7 480.5 565.1 486.2C560.4 489.7 555.6 492.1 550.6 496L545.2 499.1C540.2 501.9 534.1 504.4 529.7 506.7C520.1 510.4 511 507.5 504.7 500.5L484.9 478.3zM512 352C512 325.5 490.5 304 464 304C437.5 304 416 325.5 416 352C416 378.5 437.5 400 464 400C490.5 400 512 378.5 512 352z">
                        </path>
                    </svg>&nbsp;Setting</a> --}}
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-md-none">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="toggleSidebar()"></button>
    </div>
</ul>
<!-- End of Sidebar -->

<script>
    function toggleSidebar() {
        var collapseTwo = document.getElementById('collapseTwo');
        if (collapseTwo.classList.contains('show')) {
            collapseTwo.classList.remove('show');
        } else {
            collapseTwo.classList.add('show');
        }
    }

    window.addEventListener('resize', function() {
        var sidebarToggle = document.getElementById('sidebarToggle');
        if (window.innerWidth < 768) {
            sidebarToggle.classList.remove('d-none');
        } else {
            sidebarToggle.classList.add('d-none');
        }
    });
</script>
