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
                            <li class="breadcrumb-item active">Update Admin Details</li>
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
                                <h3 class="card-title">Update Admin Details</h3>
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
                            <form method="post" id="updateAdminDetails" action="{{ url('admin/update-admin-details') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="admin_email">Email address</label>
                                        <input class="form-control" id="admin_email" name="admin_email"
                                            value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_name">Name</label>
                                        <input type="text" class="form-control" id="admin_name" name="admin_name"
                                            placeholder="Name"
                                            value="{{ old('admin_name', optional(Auth::guard('admin')->user())->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_mobile">Mobile</label>
                                        <input type="text" class="form-control" id="admin_mobile" name="admin_mobile"
                                            placeholder="Mobile"
                                            value="{{ old('admin_mobile', optional(Auth::guard('admin')->user())->mobile) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_image">Profile Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="admin_image" class="custom-file-input"
                                                    id="admin_image">
                                                <label class="custom-file-label" for="admin_image">Choose file</label>
                                            </div>
                                        </div>
                                        @if (!empty(Auth::guard('admin')->user()->image))
                                            @php
                                                $imageName = Auth::guard('admin')->user()->image;
                                            @endphp
                                            <a href="{{ url('admin/img/photos/' . $imageName) }}" target="_blank">
                                                <img class="m-2" src="{{ url('admin/img/photos/' . $imageName) }}"
                                                    alt="Admin Photo"
                                                    style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button id="submitAdminDetailsBtn" type="submit"
                                        class="btn btn-primary">Submit</button>
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
            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");

            $.validator.setDefaults({
                submitHandler: function(form) {
                    // Disable the submit button and display loading message
                    $('#submitAdminDetailsBtn').prop('disabled', true).html('Processing...');

                    // Submit the form
                    form.submit();
                }
            });

            $('#updateAdminDetails').validate({
                rules: {
                    admin_name: {
                        required: true,
                        maxlength: 255,
                        minlength: 3,
                        lettersonly: true
                    },
                    admin_mobile: {
                        required: true,
                        number: true,
                        maxlength: 10,
                        minlength: 10
                    },
                },
                messages: {
                    admin_name: {
                        required: "Please provide a new name.",
                        maxlength: "Your name must not exceed 255 characters.",
                        minlength: "Your name must be at least 3 characters long."
                    },
                    admin_mobile: {
                        required: "Please provide a mobile number",
                        number: "Mobile number should be numbers only",
                        maxlength: "Mobile numbers must not exceed 10 digits",
                        minlength: "Mobile numbers must be 10 digits long."
                    }
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
