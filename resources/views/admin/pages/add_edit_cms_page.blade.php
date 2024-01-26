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
                                    <strong><i class="icon fas fa-ban"></i> Error Occured!</strong>
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
                                    <strong><i class="icon fas fa-check-circle"></i>Success:
                                        {{ Session::get('success_message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                            <form method="post" name="cmsForm" id="cmsForm"
                                @if (!$cmsPage->id) action="{{ url('admin/add-edit-cms-page') }}" @else action="{{ url('admin/add-edit-cms-page/' . $cmsPage->id) }}" @endif>
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title<sup>*</sup></label>
                                        <input class="form-control" id="title" name="title"
                                            value="{{ old('title', optional($cmsPage)->title) }}"
                                            placeholder="Enter page title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL<sup>*</sup></label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Enter page url" value="{{ old('url', optional($cmsPage)->url) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description<sup>*</sup></label>

                                        <textarea name="description" id="description" class="summernote" placeholder="Enter page description">{{ old('description', optional($cmsPage)->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            placeholder="Enter page seo title"
                                            value="{{ old('meta_title', optional($cmsPage)->meta_title) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input type="text" class="form-control" id="meta_description"
                                            name="meta_description" placeholder="Enter page seo description"
                                            value="{{ old('meta_description', optional($cmsPage)->meta_description) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            placeholder="Enter page seo keywords comma separated"
                                            value="{{ old('meta_keywords', optional($cmsPage)->meta_keywords) }}">
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
            var summernoteElement = $('.summernote');

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");

            $.validator.setDefaults({
                submitHandler: function(form) {
                    // Disable the submit button and display loading message
                    $('#submitCmsFormBtn').prop('disabled', true).html('Processing...');

                    // Submit the form
                    form.submit();
                }
            });

            var formValidator = $('#cmsForm').validate({
                ignore: ':hidden:not(.summernote),.note-editable.card-block',
                rules: {
                    title: {
                        required: true,
                        maxlength: 255,
                        minlength: 3,
                        lettersonly: true
                    },
                    url: {
                        required: true,
                        maxlength: 255,
                        minlength: 3,
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please provide a title of the page.",
                        maxlength: "Your title must not exceed 255 characters.",
                        minlength: "Your title must be at least 3 characters long."
                    },
                    url: {
                        required: "Please provide a url",
                        number: "url should be numbers only",
                        maxlength: "url must not exceed 255 characters",
                        minlength: "url must be at least 3 characters long."
                    },
                    description: {
                        required: "Please provide page description",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.hasClass("summernote")) {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else {
                        element.closest('.form-group').append(error);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $("#description").summernote({
                callbacks: {
                    onChange: function(contents, $editable) {
                        summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
                        formValidator.element(summernoteElement);
                    }
                }
            });
        });
    </script>
@endpush
