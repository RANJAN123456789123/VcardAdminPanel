@extends('admin.layout.common.pagemaster')
<style>
    .card-body {
        width: 100% !important;
    }

    .select2 {
        width: 100% !important;
    }

    #validationmessage404,
    #validationmessage500,
    #vcardnamemesssage,
    #usernamemessage,
    #selectstatus {
        color: red;
    }

    #nfcidmessage {
        color: red
    }

    #validationmessage {
        color: rgb(0, 112, 0)
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Add Vcard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Vcard</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header p-2">
                            <a type="button" href="{{ route('vcard') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>
                        <form id="addvcard">
                            @csrf
                            <div class="card-body">
                                <h6 id="validationmessage"></h6>
                                <h6 id="validationmessage404"></h6>
                                <h6 id="validationmessage500"></h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vcardName">VCARD NAME </label>
                                            <select name="" id="vcardid"
                                                class="form-control js-example-basic-single" onchange="selectVcard()">
                                                <option value="--Select Vcard--">--Select Vcard--</option>
                                                @foreach ($getselect as $getvalue)
                                                    <option value="{{ $getvalue->id }}">{{ $getvalue->template_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="vcardnamemesssage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleName">USER NAME </label>
                                            <select id="userid" class="form-control js-example-basic-single"
                                                onchange="SelectUser()">
                                                <option value="--Select User--">--Select User--</option>
                                                @foreach ($getuser as $getval)
                                                    <option value="{{ $getval->id }}">{{ $getval->name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="usernamemessage"></span>
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleName">NFC</label>
                                            <input type="text" id="nfscid" placeholder="ENTER NFC ID"
                                                class="form-control" name="nfc_id">
                                            <span id="nfcidmessage"></span>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permissionStatus">PREVIEW URL</label>
                                            <div class="input-group">
                                                <input type="text" id="previewurl" placeholder="Enter URL"
                                                    class="form-control" name="previewurl">
                                            </div>
                                            <span id="previewurl"></span>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleName">SELECT STATUS </label>
                                            <select id="vcardStatus" class="form-control js-example-basic-single"
                                                onchange="Selectstatus()">
                                                <option value="--Select status--">--Select status--</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <span id="selectstatus"></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-dark" value="Add">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addvcard').addEventListener('submit', function(e) {
            e.preventDefault();
            let vcardid = document.getElementById('vcardid').value;
            let userid = document.getElementById('userid').value;
            // let nfscid = document.getElementById('nfscid').value;
            let vcardStatus = document.getElementById('vcardStatus').value;

            console.log(vcardid);
            // console.log(nfscid);
            console.log(vcardStatus);

            if (vcardid === '--Select Vcard--') {
                document.getElementById('vcardnamemesssage').innerHTML = 'Select Vcard';
                setTimeout(() => {
                    document.getElementById('vcardnamemesssage').innerHTML = '';
                }, 3000);
                return;
            }



            if (userid === '--Select User--') {
                document.getElementById('usernamemessage').innerHTML = 'Select User';
                setTimeout(() => {
                    document.getElementById('usernamemessage').innerHTML = '';
                }, 3000);
                return;
            }

            // if (nfscid === '') {
            //     document.getElementById('nfcidmessage').innerHTML = 'Enter NfC ID';
            //     setTimeout(() => {
            //         document.getElementById('nfcidmessage').innerHTML = '';
            //     }, 3000);
            //     return;
            // }


            if (vcardStatus === '--Select status--') {
                document.getElementById('selectstatus').innerHTML = 'Select Status';
                setTimeout(() => {
                    document.getElementById('selectstatus').innerHTML = '';
                }, 3000);
                return;
            }
            $.ajax({
                url: '{{ route('addformVcard.post') }}',
                method: 'POST',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                },
                data: JSON.stringify({
                    vcard_id: vcardid,
                    // nfc_id: nfscid,
                    userid: userid,
                    vcard_status: vcardStatus

                }),
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('validationmessage').innerHTML =
                            '<div class="alert alert-success"><b>' + data.message + '<b></div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage').innerHTML = "";
                        }, 3000);
                    } else if (data.status === 404) {
                        document.getElementById('validationmessage404').innerHTML =
                            '<div class="alert alert-danger">' + data.message +
                            '</div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage404').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('validationmessage500').innerHTML =
                            '<div class="alert alert-secondary">' + data.message +
                            '</div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage500').innerHTML = "";
                        }, 3000);
                    }
                }
            });
        });


        function selectVcard() {
            let vcardid = document.getElementById('vcardid').value;
            if (vcardid) {
                let vcardid = document.getElementById('vcardnamemesssage').innerHTML = "";
            }

        }

        function SelectUser() {
            let userid = document.getElementById('userid').value;
            if (userid) {
                document.getElementById('usernamemessage').innerHTML = "";
            }

        }

        function Selectstatus() {
            let vcardStatus = document.getElementById('vcardStatus').value;
            if (vcardStatus) {
                document.getElementById('selectstatus').innerHTML = "";
            }

        }

        // document.getElementById('nfscid').addEventListener('input', () => {
        //     document.getElementById('nfcidmessage').innerHTML = "";
        // })
    </script>
@endsection
