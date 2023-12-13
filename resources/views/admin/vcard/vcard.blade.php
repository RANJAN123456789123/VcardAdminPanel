@php
    $createVcard = $allButtonAccessHelper->checkPermissionForActionVcard($request, 'create');
    $editVcard = $allButtonAccessHelper->checkPermissionForActionVcard($request, 'edit');
    $showVcard = $allButtonAccessHelper->checkPermissionForActionVcard($request, 'show');
    $deleteVcard = $allButtonAccessHelper->checkPermissionForActionVcard($request, 'delete');
@endphp
{{-- {{dd($deleteVcard)}} --}}
@extends('admin.layout.common.pagemaster')
<style>
    .highlight-select {
        background-color: red !important;
    }

    #Edit_message {
        color: rgb(0, 148, 7) !important;
    }

    #Edit_message_five,
    #Edit_message_notffound,
    #modulemessage,
    #permnissionmessage,
    #vcardmessage,
    #usermessage {
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
                        <h4>Vcard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Vcard</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header">
                <h3 class="card-title">All Vcard</h3>
                <ul class="list-unstyled">
                    <li>
                        @if ($createVcard === 'active')
                            <a type="button" href="{{ route('addvcard') }}" class="btn btn-dark btn-sm float-right">Add
                                Vcard</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" data-sortable="true">NO</th>
                            <th class="text-center" data-sortable="true">VCARD NAME</th>
                            <th class="text-center" data-sortable="true">USER NAME</th>
                            <th class="text-center" data-sortable="true">PREVIEW URL</th>
                            <th class="text-center" data-sortable="true">CREATED DATE</th>
                            @if ($editVcard === 'active' || $deleteVcard === 'active')
                                <th class="text-center">Action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $geturl = url('/');

                        @endphp
                        @foreach ($getvcardmodel as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $i++ }}
                                </td>
                                <td class="text-center">
                                    @if (isset($matchedResults[$item->vcard_id]))
                                        <img src="{{ asset('img/' . $matchedResults[$item->vcard_id]['template_photo']) }}"
                                            alt="Vcard image" width="80px" height="80px" class="mr-2 rounded-circle">
                                        <span>{{ $matchedResults[$item->vcard_id]['template_name'] }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ isset($item->usermodel->name) ? $item->usermodel->name : 'NA' }}
                                </td>
                                <td class="text-center">
                                    <a
                                        href="{{ url('geturlid/' . $item->id) }}">{{ isset($geturl) ? $geturl : 'NA' }}/{{ isset($item->usermodel->name) ? $item->usermodel->name : 'NA' }}</a>
                                </td>

                                <td class="text-center"><span class="badge badge-secondary">{{ $item->created_at }}</span>
                                </td>

                                @if ($editVcard === 'active' || $deleteVcard === 'active')
                                    <td class="text-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                @if ($editVcard === 'active')
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="openEditVcard('{{ $item->id }}')" data-toggle="modal"
                                                        data-target="#editVcard" data-get-id="{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif

                                                @if ($deleteVcard === 'active')
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="deleteVcard('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>


    <div class="modal" id="editVcard" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Vcard</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <h6 id="Edit_message"></h6>
                <h6 id="Edit_message_five"></h6>
                <h6 id="Edit_message_notffound"></h6>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="myForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFirstName">VCARD NAME</label>

                                    <select class="form-control js-example-basic-single" id="vcard_id">
                                        <option>--Select Vcard--</option>
                                        @foreach ($getvcartemp as $item)
                                            <option value="{{ $item->id }}">{{ $item->template_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="vcardmessage"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleLastName">USER NAME</label>
                                    <select class="form-control js-example-basic-single" id="userid">
                                        <option>--Select User--</option>
                                        @foreach ($getuserdata as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="usermessage"></span>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleLastName">SELECT STATUS</label>
                                    <select class="form-control js-example-basic-single" name="vcard_status"
                                        id="vcard_statu" data-permission="">
                                        <option>--Select STATUS--</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <span id="statusmessage"></span>
                                </div>
                            </div> --}}

                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-dark" value="Update">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <!-- Add your update button or any other necessary buttons here -->
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->

            </div>
        </div>
    </div>
    <script>
        let getidedit = '';

        function openEditVcard(id) {
            $.ajax({
                url: '{{ route('editvcard.post', ['id' => '__id__']) }}'.replace('__id__', id),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(data) {
                    let vcardId = data.data.vcard_id;
                    let userId = data.data.user_id;

                    var vcard_id = document.getElementById('vcard_id');
                    var userid = document.getElementById('userid');

                    for (var i = 0; i < vcard_id.options.length; i++) {
                        if (vcard_id.options[i].value === vcardId) {
                            var temp = vcard_id.options[i].outerHTML;
                            vcard_id.remove(i);
                            vcard_id.insertAdjacentHTML('afterbegin', temp);
                            vcard_id.selectedIndex = 0;
                        }
                    }

                    for (var i = 0; i < userid.options.length; i++) {
                        if (userid.options[i].value === userId) {
                            var temp = userid.options[i].outerHTML;
                            userid.remove(i);
                            userid.insertAdjacentHTML('afterbegin', temp);
                            userid.selectedIndex = 0;
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        window.addEventListener('load', function() {
            document.getElementById('editVcard').addEventListener("submit", function(e) {
                e.preventDefault();
                let getdataid = getidedit;
                openEditVcard(getdataid);
                console.log(getdataid);


                let vcardid = document.getElementById('vcard_id').value;
                let userid = document.getElementById('userid').value;


                if (vcardid === '--Select Vcard--') {
                    document.getElementById('vcardmessage').innerHTML =
                        "Select Vcard Name";
                    setTimeout(() => {
                        document.getElementById('vcardmessage').innerHTML = "";
                    }, 3000);
                } else if (userid === '--Select User--') {
                    document.getElementById('usermessage').innerHTML = "Select User Name";
                    setTimeout(() => {
                        document.getElementById('usermessage').innerHTML = "";
                    }, 3000);
                } else {
                    $.ajax({
                        url: '{{ route('vcardUpdate.post', ['id' => '__id__']) }}'.replace(
                            '__id__',
                            getdataid),
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: JSON.stringify({
                            vcard_id: vcardid,
                            userid: userid
                        }),
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 200) {
                                document.getElementById('Edit_message').innerHTML =
                                    "<div class='alert alert-success'><b>Updated Success!<b></div>'";
                                setTimeout(() => {
                                    document.getElementById('Edit_message').innerHTML =
                                        "";
                                }, 3000);
                                window.location.href = data.redirect;
                            } else if (data.status === 404) {
                                document.getElementById('Edit_message_notffound').innerHTML =
                                    "<div class='alert alert-danger'><b>" + data.message +
                                    "</b></div>";
                                setTimeout(() => {
                                    document.getElementById('Edit_message_notffound')
                                        .innerHTML = "";
                                }, 3000);
                            } else {
                                document.getElementById('Edit_message_five').innerHTML =
                                    "<div class='alert alert-danger'><b>" + data.message +
                                    "</b></div>";
                                setTimeout(() => {
                                    document.getElementById('Edit_message_five')
                                        .innerHTML =
                                        "";
                                }, 3000);
                            }
                        }
                    });
                }
            });

            document.querySelectorAll('[data-get-id]').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('vcard_id').addEventListener('change',
                        function() {
                            document.getElementById('vcardmessage').innerHTML = "";
                        });

                    document.getElementById('userid').addEventListener('change',
                        function() {
                            document.getElementById('usermessage').innerHTML = "";
                        });

                    getidedit = this.getAttribute('data-get-id');
                });
            });
        });
    </script>


    <script>
        function deleteVcard($id) {
            if (confirm('Are you sure you want to delete this vcard user?')) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route('deleteVcard.post', ['id' => '__id__']) }}'.replace('__id__', $id),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: $id
                    }),
                    success: function(data) {
                        if (data.status === 200) {
                            alert(data.message);
                            window.location.href = data.redirect;
                        } else if (data.status === 404) {
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    }
                })
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }
    </script>
@endsection
