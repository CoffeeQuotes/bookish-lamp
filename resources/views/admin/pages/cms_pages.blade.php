@extends('admin.layout.layout')
@push('page-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cms Pages</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">CMS Pages</a></li>
                            <li class="breadcrumb-item active">Pages</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{ url('admin/add-edit-cms-page') }}"><i
                                        class="fas fa-plus"></i> New page</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                                        <strong><i class="icon fas fa-check-circle"></i>Success:
                                            {{ Session::get('success_message') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                                <table id="cmspages" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Url</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CmsPages as $CmsPage)
                                            <tr>
                                                <td>{{ $CmsPage['id'] }}</td>
                                                <td>{{ $CmsPage['title'] }}</td>
                                                <td>{{ $CmsPage['url'] }}</td>
                                                <td>{{ Carbon\Carbon::parse($CmsPage['created_at'])->format('d-m-Y') }}
                                                </td>
                                                <td class="d-flex justify-content-between flex-row">

                                                    @php
                                                        $status = (int) $CmsPage['status'];
                                                    @endphp
                                                    {{-- <input type="checkbox" name="status"
                                                        @if ($status === 1) checked @else @endif
                                                        data-bootstrap-switch data-off-color="danger"
                                                        data-on-color="success" data-on-text="Active"
                                                        data-off-text="Inactive"> --}}
                                                    @if ($status === 1)
                                                        <a class="updatePageStatus" id="page-{{ $CmsPage['id'] }}"
                                                            page_id="{{ $CmsPage['id'] }}" href="javascript:void(0)">
                                                            <i class="text-success fas fa-toggle-on" status="active"></i>
                                                        </a>
                                                    @else
                                                        <a class="updatePageStatus" id="page-{{ $CmsPage['id'] }}"
                                                            page_id="{{ $CmsPage['id'] }}" href="javascript:void(0)">
                                                            <i class="text-danger fas fa-toggle-off" status="inactive"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ url('admin/add-edit-cms-page/' . $CmsPage['id']) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url('admin/delete-cms-page/' . $CmsPage['id']) }}"
                                                        onclick="return confirm('Are you sure you want to delete this page?')">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@push('page-script')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#cmspages").DataTable();
        });
    </script>
@endpush
