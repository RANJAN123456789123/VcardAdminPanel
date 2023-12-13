@extends('admin.layout.common.pagemaster')
<style>
    .card-body {
        width: 100% !important;
    }

    .select2 {
        width: 100% !important;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Plain</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Plain</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card mx-3">
            <div class="card-header">
                <form id="form_id" action="" method="GET">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="fname">Plain Name</label>
                                <input type="text" placeholder="Vcard Search" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button id="registerSubmit" class="btn btn-dark" type="submit">SEARCH</button>
                    <a href="#" type="button" value="submit" class="btn btn-dark"> CLEAR</a>
                </form>

            </div>

        </div>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header p-2">
                <h4>All Plain</h4>

            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table data-toggle="table" data-striped="true" class="table table-hover table-nowrap mb-0" id="example4">
                    <thead>
                        <tr>
                            <th class="text-center" data-sortable="true">NO</th>
                            <th class="text-center" data-sortable="true">NAME</th>

                            <th class="text-center" data-sortable="true">PRICE</th>
                            <th class="text-center" data-sortable="true">STATUS</th>
                            <th class="text-center" data-sortable="true">DURATION</th>
                            <th class="text-center" data-sortable="true">MAKE DEFUALT</th>
                            <th class="text-center" data-sortable="true">CREATED AT</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="text-center">1</td>
                        <td class="text-center">Admin</td>
                        <td class="text-center">Free</td>
                        <td class="text-center">button on off</td>
                        <td class="text-center">button on off</td>
                        <td class="text-center">2011-04-25</td>

                    </tbody>
                </table>
                <br>
            </div>

        </div>


    </div>
@endsection
