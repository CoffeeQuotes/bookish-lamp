@extends('admin.layout.layout')
@push('page-css')
    <link rel="stylesheet" href="{{ url('/admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">CMS Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
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
                                <h3 class="card-title">{{ $title }}</h3>
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
                            <form method="post" name="cmsForm" id="cmsForm"
                                action="{{ url('admin/add-edit-cms-page') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title<sup>*</sup></label>
                                        <input class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="Enter page title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL<sup>*</sup></label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Enter page url" value="{{ old('url') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description<sup>*</sup></label>

                                        <textarea name="description" id="description" placeholder="Enter page description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title<sup>*</sup></label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Enter page seo title" value="{{ old('meta_title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description<sup>*</sup></label>
                                        <input type="text" class="form-control" id="meta_description"
                                            name="meta_description" placeholder="Enter page seo description"
                                            value="{{ old('meta_description') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords<sup>*</sup></label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            placeholder="Enter page seo keywords comma separated"
                                            value="{{ old('meta_keywords') }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button id="submitCmsFormBtn" type="submit" class="btn btn-primary">Submit</button>
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
    <!-- Summernote -->
    <script src="{{ url('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $("#description").summernote();
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
