@extends('cms.layout.admin-login')

@section('htmlheader_title', 'Forgot Password')

@section('content')
    <div class="login-signin">
        <div class="mb-20">
            <h3 class="opacity-40 font-weight-normal">Forgot Password</h3>
        </div>
        {!! Form::open(array('route' => 'admin.forgot-password' , 'class' => 'form', 'id'=>'forgot-password','autocomplete' => 'off')) !!}
            <div class="form-group">
                {!! Form::email('email', null, ['class' => 'form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8','placeholder' => 'Enter email']) !!}
            </div>
            <div class="form-group d-flex flex-wrap px-8 opacity-60">
                <p class="mr-2">Remember Credentials? </p><a href="{{ route('admin.signin') }}" id="kt_login_forgot" class="text-white font-weight-bold">Sign In</a>
            </div>
            <div class="form-group text-center mt-10">
                <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Send Reset Link</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection

@section('script')
{!! $validator->selector('#forgot-password') !!}
@endsection
