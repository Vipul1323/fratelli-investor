@extends('cms.layout.admin-login')

@section('htmlheader_title', 'Sign in')

@section('content')
    <div class="login-signin">
        <div class="mb-20">
            <h3 class="opacity-40 font-weight-normal">Sign In To Admin</h3>
        </div>
        {!! Form::open(array('route' => 'admin.signin' , 'class' => 'form', 'id'=>'signin','autocomplete' => 'off')) !!}
            <div class="form-group">
                {!! Form::email('email', null, ['class' => 'form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8','placeholder' => 'Enter email']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8','placeholder' => 'Enter password']) !!}
            </div>
            <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                <div class="checkbox-inline">
                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                    <input type="checkbox" value="true" name="remember" />
                    <span></span>Remember me</label>
                </div>
                <a href="{{ route('admin.forgot-password') }}" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
            </div>
            <div class="form-group text-center mt-10">
                <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection

@section('script')
{!! $validator->selector('#signin') !!}
@endsection