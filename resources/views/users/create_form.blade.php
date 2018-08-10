@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users / create</h1>
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
                        {!! Form::open(['url' => 'users/create', 'name' => 'dataForm', 'id' => 'dataForm']) !!}
                            <div class="form-group">
                                <label for="InputName">Name</label>
                                <input type="text" class="form-control" id="InputName" name="name" placeholder="Name" autocomplete='name' required>
                            </div>
                            <div class="form-group">
                                <label for="InputEmail">Email</label>
                                <input type="text" class="form-control" id="InputEmail" name="email" placeholder="email" autocomplete='email' required>
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">Password</label>
                                <input type="password" class="form-control" id="InputPassword" name="password" placeholder="password" autocomplete='off' required>
                            </div>
                            <div class="form-group">
                                <label for="InputRole">Role</label>
                                <select class="form-control" id="InputRole" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputDepartment">Department</label>
                                <select class="form-control" id="InputDepartment" name="department">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="InputManager">Manager</label>
                                <select class="form-control" id="InputManager" name="manager">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <button type="submit" class="btn btn-block btn-primary" id="btnSubmit">Submit</button>
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
                    maxlength: 255
                },
                password: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
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
