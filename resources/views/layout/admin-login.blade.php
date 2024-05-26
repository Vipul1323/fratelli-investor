<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('htmlheader_title', '')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('favicon.png')}}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">

    {{ HTML::style('cms/css/lite-orange.min.css') }}
</head>
<body>
	<div class="auth-layout-wrap" style="background: #0f1a3c;">
	    <div class="auth-content">
	        <div class="card o-hidden">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="p-4">
	                        <div class="auth-logo text-center mb-4">
	                        	<img src="{{ url('cms/image/logo.png') }}" alt="logo">
	                        </div>

	                        @yield('main-content')

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@section('scripts')
    @include('layout.partials.admin.login-scripts')
@show
<!-- Add Js Code from View -->
@yield('js_script')

</body>
</html>