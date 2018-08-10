@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Customer / create</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading hide text-center" id="message">

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('modal')
                        {!! Form::open(['url' => 'roles/create', 'name' => 'dataForm', 'id' => 'dataForm']) !!}
                            <div class="form-group">
                                <label for="InputName">Name</label>
                                <input type="text" class="form-control" id="InputName" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="InputEmail">Email</label>
                                <input type="text" class="form-control" id="InputEmail" name="email" placeholder="email" autocomplete='email' required>
                            </div>
                            <div class="form-group">
                                <label for="InputPhone">Phone</label>
                                <input type="text" class="form-control" id="InputPhone" name="phone" placeholder="Phone" autocomplete='phone' required>
                            </div>
                            <div class="form-group">
                                <label for="InputBusinessUnit">Business Unit</label>
                                <select class="form-control" id="InputBusinessUnit" name="business_unit">
                                    @foreach($business_units as $business_unit)
                                        <option value="{{ $business_unit->id }}">{{ $business_unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputCampaign">Campaign</label>
                                <select class="form-control" id="InputCampaign" name="campaign">
                                    @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        {!! Form::close() !!}

                    </div>
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
    <script>
        $('#dataForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 20
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                phone: {
                    required: true,
                    maxlength: 20,
                    minlength: 8
                },
                message: {
                    required: true
                },
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "text-danger" );
                error.insertAfter( element );
            },
            submitHandler: function (form) {
                $.ajax({
                    url : 'create',
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
