@extends('cms.layout.admin-login')

@section('htmlheader_title', 'Reset Password')

@section('content')
    <div class="login-signin">
        <div class="mb-20">
            <h3 class="opacity-40 font-weight-normal">Reset Password</h3>
        </div>
        {!! Form::open(array('route' => 'admin.reset-password' , 'class' => 'form', 'id'=>'reset-password','autocomplete' => 'off')) !!}
            {{ Form::hidden('id',$user->encode_id) }}
    	    {{ Form::hidden('reset_token',$user->reset_token) }}
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8','placeholder' => 'Enter password']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('confirm_password', ['class' => 'form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8','placeholder' => 'Enter confirm password']) !!}
            </div>
            <div class="form-group d-flex flex-wrap px-8 opacity-60">
                <a href="{{ route('admin.forgot-password') }}" id="kt_login_forgot" class="text-white font-weight-bold">Forgot Password?</a>
            </div>
            <div class="form-group text-center mt-10">
                <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Reset Password</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection

@section('script')
{!! $validator->selector('#reset-password') !!}
@endsection