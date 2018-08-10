@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Departments / modify</h1>
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
                        {!! Form::open(['url' => 'dispositions/update', 'name' => 'dataForm', 'id' => 'dataForm']) !!}
                        <input type="hidden" id="InputId" name="id" value="{{ $department->id }}">
                        <div class="form-group">
                            <label for="InputName">Name</label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Name" value="{{ $department->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="textDescription">Description</label>
                            <textarea class="form-control" id="textDescription" name="description" placeholder="Description" required>{{ $department->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary" id="btnSubmit">Modify</button>
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
                description: {
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
                    url : '{{ route('departments.update_data') }}',
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
