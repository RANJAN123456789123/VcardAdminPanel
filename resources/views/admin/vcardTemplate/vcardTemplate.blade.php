@php
    $createVcardTemp = $allButtonAccessHelper->checkPermissionForActionVcardTemp($request, 'create');
    $editUserVcardTemp = $allButtonAccessHelper->checkPermissionForActionVcardTemp($request, 'edit');
    $showUserVcardTemp = $allButtonAccessHelper->checkPermissionForActionVcardTemp($request, 'show');
    $deleteUserVcardTemp = $allButtonAccessHelper->checkPermissionForActionVcardTemp($request, 'delete');
@endphp


@extends('admin.layout.common.pagemaster')

<style>
    .highlight-select {
        background-color: red !important;
    }

    #Edit_message {
        color: green !important;
    }

    #Edit_message_five,
    #Edit_message_notffound,
    #modulemessage,
    #permnissionmessage,
    #passwordmessage,
    #confirmpasswordmessage {
        color: red !important;
    }
</style>



@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>vCard Template</h4>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">vCard Template</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="card mx-3 card-primary">

            <div class="card">
                <div class="card-body table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="thead-custom">
                            <tr>
                                <th class="text-center" data-sortable="true">NAME</th>
                                <th class="text-center" data-sortable="true">USED COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard1') }}">
                                        <img src="{{ asset('img/vcard1.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard1</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"> <span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v1']) ? $vCounts['v1'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard2') }}">
                                        <img src="{{ asset('img/vcard2.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard2</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"> <span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v2']) ? $vCounts['v2'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard3') }}">
                                        <img src="{{ asset('img/vcard3.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard3</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v3']) ? $vCounts['v3'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard4') }}">
                                        <img src="{{ asset('img/vcard4.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard4</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v4']) ? $vCounts['v4'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard5') }}">
                                        <img src="{{ asset('img/vcard5.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard5</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v5']) ? $vCounts['v5'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard6') }}">
                                        <img src="{{ asset('img/vcard6.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard6</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v6']) ? $vCounts['v6'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard7') }}">
                                        <img src="{{ asset('img/vcard7.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard7</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v7']) ? $vCounts['v7'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard8') }}">
                                        <img src="{{ asset('img/vcard8.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard8</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v8']) ? $vCounts['v8'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard9') }}">
                                        <img src="{{ asset('img/vcard9.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard9</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v9']) ? $vCounts['v9'] : 'NA' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" data-sortable="true">
                                    <a href="{{ route('vcard10') }}">
                                        <img src="{{ asset('img/vcard10.png') }}" alt="Vcard image" width="80px"
                                            height="80px" class="mr-2 rounded-circle">
                                        <span>Vcard10</span>
                                    </a>
                                </td>
                                <td class="text-center" data-sortable="true"><span class="badge badge-warning"
                                        style="font-size:15px">{{ isset($vCounts['v10']) ? $vCounts['v10'] : 'NA' }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
