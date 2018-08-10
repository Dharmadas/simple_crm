@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Customers <a href="{{ route('customers.show_create_form') }}"><button class="btn btn-primary">Add New</button></a></h1>
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "processing" : true,
                "paging" : true,
                "serverSide" : true,
                "ajax" : "{{ route('customers.data') }}",
                "columns" : [
                    {"data" : "id","fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='customers/" + oData.id + "/updates'>" + oData.id +"</a>");
                        }
                    },
                    {"data" : "name"},
                    {"data" : "email"},
                    {"data" : "phone"},
                ]
            });
        });
    </script>
@endsection
