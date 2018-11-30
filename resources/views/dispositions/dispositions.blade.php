@extends('layouts.app')

@section('style')
    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"-->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dispositions <a href="{{ route('dispositions.show_create_form') }}"><button class="btn btn-primary">Add New</button></a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!--div class="panel-heading">
                    DataTables Advanced Tables
                </div-->
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>

                            @can('role_access', 'update_disposition')
                            <th>Action</th>
                            @endcan

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dispositions as $disposition)
                            <tr>
                                <td>{{ $disposition->name }}</td>
                                <td>{{ $disposition->description }}</td>

                                @can('role_access', 'update_disposition')
                                <td><a href="dispositions/{{ $disposition->id }}/update"><button class="btn btn-primary">Modify</button></a></td>
                                @endcan

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('javascript')
    <!-- DataTables JavaScript -->
    <script src="{{  asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/buttons.flash.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/jszip.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection
