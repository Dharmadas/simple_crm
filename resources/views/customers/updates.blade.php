@extends('layouts.app')

@section('style')
    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"-->
@endsection

@section('content')
    <!--div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">
            <h1 class="page-header">Customer</h1>
        </div>
        <!-- /.col-lg-12 -->
    <!--/div-->
    <!-- /.row -->
    <!--div class="row"-->
        <!--div class="col-lg-12">
            <div class="panel panel-default">
                <!--div class="panel-heading">
                    DataTables Advanced Tables
                </div-->
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!--div class="panel-heading">
                        Basic Information
                    </div-->
                    <!-- /.panel-heading -->


                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table width="100%" class="table table-responsive">
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td class="text-right">
                                                <strong>Name</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->name }}
                                            </td>
                                            <td class="text-right">
                                                <strong>Email</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <strong>Phone</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->phone }}
                                            </td>
                                            <td class="text-right">
                                                <strong>Creator</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->creator }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <strong>Business Unit</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->business_unit }}
                                            </td>
                                            <td class="text-right">
                                                <strong>Campaign</strong>
                                            </td>
                                            <td><strong>:</strong></td>
                                            <td class="text-left">
                                                {{ $customer->campaign }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading hide text-center" id="message"></div>
                            <div class="panel-body">
                                {{ Form::open(['url' => 'customers/update', 'name' => 'dataForm', 'id' => 'dataForm']) }}
                                <input type="hidden" id="customer" name="customer" value="{{ $customers{0}->id }}">
                                <div class="form-group">
                                    <label for="InputDisposition">Disposition</label>
                                    <select class="form-control" id="InputDisposition" name="disposition">
                                        @foreach($dispositions as $disposition)
                                            <option value="{{ $disposition->id }}">{{ $disposition->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="textMessage">Message</label>
                                    <textarea class="form-control" style="height: 100px;" id="textMessage" name="message" placeholder="Message" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary" id="btnSubmit">Submit</button>
                                {{ Form::close() }}
                            </div>
                        </div>

                        <div class="panel panel-info">

                                @foreach($userUpdates as $userUpdate)
                                    <div class="panel-heading">
                                        @if($userUpdate->user_id == \Auth::User()->id)
                                            <strong> Me </strong> :
                                        @else
                                            <strong>{{ $userUpdate->user_name }}</strong> :
                                        @endif
                                        {{ $userUpdate->disposition }}
                                        <div class="pull-right">{{ $userUpdate->created_at }}</div>
                                    </div>
                                    <div class="panel-body">
                                        {{ $userUpdate->message }}
                                    </div>
                                @endforeach

                        </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        <!--/div-->
        <!-- /.col-lg-12 -->
    <!--/div-->
    <!-- /.row -->
@endsection

@section('javascript')
    <script>
        $('#dataForm').validate({
            rules: {
                message: {
                    required: true,
                    maxlength: 255
                }
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "text-danger" );
                error.insertAfter( element );
            },
            submitHandler: function (form) {
                $.ajax({
                    url : '{{ route('customers.add_update') }}',
                    data: $('#dataForm').serialize(),
                    type: 'POST',
                    dataType: 'json',
                    success: function (message) {
                        $('#message').html(message.response);
                        $('#message').removeClass('hide');
                        $('#message').slideDown();
                        $('#exampleModalCenter').modal('hide');
                        if(message.status == "true"){
                            $('#message').addClass('alert-success');
                            $('#message').removeClass('alert-danger');
                            $('#btnSubmit').attr("disabled", "disabled");
                        }else{
                            $('#message').addClass('alert-danger');
                            $('#message').removeClass('alert-success');
                        }

                    },
                    beforeSend: function ($message) {
                        $('#exampleModalCenter').modal({backdrop: 'static', keyboard: false});
                    }
                });
                return false;
            }
        });
    </script>
@endsection
