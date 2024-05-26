<!DOCTYPE html>
<html lang="en" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('htmlheader_title', '')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('favicon.png')}}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{ HTML::style('cms/css/toastr.min.css') }}
    {{ HTML::style('cms/css/lite-orange.min.css') }}
    {{ HTML::style('cms/css/plugins/perfect-scrollbar.min.css') }}
    {{ HTML::style('cms/css/custom.css') }}
    {{ HTML::script('js/jquery-3.4.1.min.js') }}
    {{ HTML::style('cms/css/select2.css') }}

</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        <!-- Header -->
        @include('layout.partials.admin.header')

        <!-- Sidebar -->
        @include('layout.partials.admin.sidebar')

        <!-- =============== Left side End ================-->

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">

                @include('layout.partials.admin.breadcrumb')

                <div class="separator-breadcrumb border-top"></div>

                <div class="row mb-4">
                    @yield('main-content')
                </div>

                <!-- end of main-content -->
            </div>

            <!-- Footer Start -->
            @include('layout.partials.admin.footer')
            <!-- Footer end -->
        </div>
    </div>

    @include('layout.partials.admin.auth-scripts')

    <!-- Add Js Code from View -->
    @yield('js_script')
</body>

</html>