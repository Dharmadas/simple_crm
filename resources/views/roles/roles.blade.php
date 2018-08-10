@extends('layouts.app')

@section('style')
    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"-->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Roles <a href="{{ route('roles.show_create_form') }}"><button class="btn btn-primary">Add New</button></a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!--div class="panel-heading">

                </div-->
                <!-- /.panel-heading -->
                <div class="panel-body">

                        <table width="100%" class="table table-striped table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Permissions</th>

                                    @can('role_access', 'update_role')
                                    <th>Action</th>
                                    @endcan

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <?php
                                            $permissions = explode(",", $role->permissions);
                                            sort($permissions);
                                            foreach ($permissions as $value){
                                                echo $value . "<br>";
                                            }
                                        ?>
                                    </td>

                                    @can('role_access', 'update_role')
                                    <td><a href="roles/{{ $role->id }}/update"><button class="btn btn-primary">Modify</button></a></td>
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
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
