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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="cmspages" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Url</th>
                                            <th>Status</th>
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
                                                <td>
                                                    @php
                                                        $status = (int) $CmsPage['status'];
                                                    @endphp
                                                    <input type="checkbox" name="status"
                                                        @if ($status === 1) checked @else @endif
                                                        data-bootstrap-switch data-off-color="danger"
                                                        data-on-color="success" data-on-text="Active"
                                                        data-off-text="Inactive">

                                                </td>
                                                <td>{{ Carbon\Carbon::parse($CmsPage['created_at'])->format('d-m-Y') }}
                                                </td>
                                                <td></td>
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

    <!-- Bootstrap Switch -->
    <script src="{{ url('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#cmspages").DataTable();
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        });
    </script>
@endpush
