@extends('cms.layout.app')

@section('htmlheader_title', "Change Password")

@section('module', "Change Password")

@section('content')
    <div class="card card-custom gutter-b">
        {{ Form::open(array('class' => 'form','id'=>'changePasswordForm','url'=>'/admin/change-password')) }}
            <div class="card-body">
                {{ Form::hidden('role_id', env('USER_ROLE',4)) }}
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('old_password', 'Current Password') !!}
                        {{ Form::password('old_password', array('id'=>'old_password','class' => 'form-control','placeholder'=>'Current Password')) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('password', 'New Password') !!}
                        {{ Form::password('password', array('id'=>'password','class' => 'form-control','placeholder'=>'New Password')) }}
                    </div>
                    <div class="col-lg-4">
                        {!! Form::label('password_confirmation', 'Confirm Password') !!}
                        {{ Form::password('password_confirmation', array('id'=>'password_confirmation','class' => 'form-control','placeholder'=>'Confirm Password')) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Change Password',['class' => 'btn btn-sm btn-primary','id' => 'signup-first-form-submit']) !!}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('script')
    {!! $validator->selector('#changePasswordForm') !!}
@endsection