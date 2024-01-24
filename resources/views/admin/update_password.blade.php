@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active">Update Admin Password</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Admin Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                                    <strong><i class="icon fas fa-ban"></i> Invalid Credentials!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                                    <strong><i class="icon fas fa-ban"></i>Error:
                                        {{ Session::get('error_message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                                    <strong><i class="icon fas fa-ban"></i>Success:
                                        {{ Session::get('success_message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                            <form method="post" id="updateAdminPassword" action="{{ url('admin/update-password') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="admin_email">Email address</label>
                                        <input class="form-control" id="admin_email" name="admin_email"
                                            value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" placeholder="Current Password">
                                        <span id="verifyCurrentPassword"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                        <!-- general form elements -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@push('page-script')
    <script src="{{ url('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    $('#updateAdminPassword').submit()
                }
            });
            $('#updateAdminPassword').validate({
                rules: {
                    current_password: {
                        required: true,
                        maxlength: 20,
                        minlength: 6,
                    },
                    password: {
                        required: true,
                        maxlength: 20,
                        minlength: 6,
                    },
                    password_confirmation: {
                        required: true,
                        maxlength: 20,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a new password.",
                        maxlength: "Your new password must not exceeds 20 characters.",
                        minlength: "Your new passowrd must be at least 6 characters long."
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
