@extends('layouts.app')

@section('style')
    <!link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"-->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users Profile</h1>
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
                    <table width="100%" class="table">
                        @foreach($user as $u)
                        <tbody>
                        <tr>
                            <th class="pull-right">Name</th>
                            <th>:</th>
                            <td class="pull-left">{{ $u->name }}</td>
                        </tr>
                        <tr>
                            <th class="pull-right">Email</th>
                            <th>:</th>
                            <td class="pull-left">{{ $u->email }}</td>
                        </tr>
                        <tr>
                            <th class="pull-right">Manager</th>
                            <th>:</th>
                            <td class="pull-left">{{ $u->manager }}</td>
                        </tr>
                        <tr>
                            <th class="pull-right">Department</th>
                            <th>:</th>
                            <td class="pull-left">{{ $u->department }}</td>
                        </tr>
                        <tr>
                            <th class="pull-right">Role</th>
                            <th>:</th>
                            <td class="pull-left">{{ $u->role }}</td>
                        </tr>
                        </tbody>
                        @endforeach
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