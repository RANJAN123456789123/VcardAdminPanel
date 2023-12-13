@php
    $createRole = $allButtonAccessHelper->checkPermissionForActionRole($request, 'create');
    $editRole = $allButtonAccessHelper->checkPermissionForActionRole($request, 'edit');
    $showRole = $allButtonAccessHelper->checkPermissionForActionRole($request, 'show');
    $deleteRole = $allButtonAccessHelper->checkPermissionForActionRole($request, 'delete');
@endphp

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
    #permnissionmessage {
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
                        <h4>Role</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header">
                <h3 class="card-title">All Role</h3>
                <ul class="list-unstyled">
                    <li>
                        @if ($createRole === 'active')
                            <a type="button" href="{{ route('addRole') }}" class="btn btn-dark btn-sm float-right">Add
                                Role</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" data-sortable="true">NO</th>
                            <th class="text-center" data-sortable="true">ROLE NAME</th>

                            @if ($editRole === 'active')
                                <th class="text-center" data-sortable="true">ROLE STATUS</th>
                            @endif

                            <th class="text-center" data-sortable="true">CREATED DATE</th>
                            @if ($editRole === 'active' || $deleteRole === 'active')
                                <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($getallrole as $key => $getrole)
                            <tr>
                                <td class="text-center">
                                    {{ $i++ }}
                                </td>
                                <td class="text-center">{{ $getrole->role_name }}</td>

                                @if ($editRole === 'active')
                                    <td class="text-center">
                                        <form id="{{ $getrole->id }}">
                                            @csrf
                                            <label class="switch">
                                                <input type="checkbox" name="role_status"
                                                    onclick="toggleButtonConfirm(event)" class="toggle-permission"
                                                    data-roleid="{{ $getrole->id }}"
                                                    {{ $getrole->role_status === 'active' ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                @endif

                                <td class="text-center"><span class="badge badge-secondary">{{ $getrole->created_at }}</span></td>

                                @if ($editRole === 'active' || $deleteRole === 'active')
                                    <td class="text-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                @if ($editRole === 'active')
                                                    <a href="{{ url('editRole', $getrole->id) }}" class="btn btn-primary">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif
                                                @if ($deleteRole === 'active')
                                                    <a href="#" onclick="deleteroleId('{{ $getrole->id }}')"
                                                        class="btn btn-danger">
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


    <script>
        function toggleButtonConfirm(event) {
            if (confirm('Are you sure you want to change the status?')) {
                alert('Are you sure you want to change the status?');
                document.querySelectorAll('.toggle-permission').forEach(function(toggle) {
                    toggle.addEventListener('change', function() {
                        let roleid = this.dataset.roleid;
                        let rolestatus = this.checked ? 'active' : 'inactive';
                        console.log(roleid);
                        console.log(rolestatus);

                        $.ajax({
                            url: '{{ route('roleTogglePermission.post') }}',
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: JSON.stringify({
                                id: roleid,
                                role_status: rolestatus,
                            }),
                            success: function(data) {
                                if (data.message === 200) {
                                    alert(data.message);
                                } else if (data.message === 404) {
                                    alert(data.message);
                                } else {
                                    alert(data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }
    </script>


    <script>
        let userId = '';

        function deleteroleId(id) {
            const userId = parseInt(id, 10); // Specify the radix (base) as 10 for decimal numbers
            if (isNaN(userId)) {
                console.error('Invalid user ID:', id);
                return;
            }
            if (confirm('Are you sure you want to delete this role?')) {
                $.ajax({
                    url: '{{ route('roleDelete.post', ['id' => '__id__']) }}'.replace(
                        '__id__', userId),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: userId,
                    }),
                    success: function(data) {
                        if (data.status === 200) {
                            alert(data.message);
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        } else if (data.status === 404) {
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }


        }
    </script>
@endsection
