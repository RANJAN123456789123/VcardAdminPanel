@extends('admin.layout.common.pagemaster')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Admin</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card mx-3">

        </div>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header p-2">
                @if ($adminCreate === 'active')
                    <h1>Admin Create</h1>
                @else
                    <p>Unauthorized</p>
                @endif
            </div>
            <!-- /.card-header -->

        </div>


    </div>
@endsection
