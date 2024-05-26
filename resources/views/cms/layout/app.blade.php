<!DOCTYPE html>

<html lang="en">

	<head>
        <base href="">
		<meta charset="utf-8" />
		<title>@yield('htmlheader_title', 'Home') | {{ env('APP_NAME') }}</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<link href="{{ url('/admin/') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/admin/') }}/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type='image/x-icon' href="{{ url('/admin/') }}/media/logos/favicon.ico" />

        @yield('style')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<!--begin::Logo-->
			<a href="{{ route('admin.dashboard') }}" title="{{ env('APP_NAME') }}">
				<img alt="{{ env('APP_NAME') }}" width="175px;" src="{{ url('/admin/') }}/media/logos/Fratelli_Logo_Black.webp" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Aside Mobile Toggle-->
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<!--end::Aside Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->

		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
				@include('cms.layout.partials.sidebar')
				<!--end::Aside-->

				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					@include('cms.layout.partials.header')
					<!--end::Header-->

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                        @include('cms.layout.partials.breadcrumbs')

						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<div class="container">
								@yield('content')
							</div>
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->

					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved </span>
							</div>
						</div>
					</div>
					<!--end::Footer-->

				</div>
			</div>
		</div>
		<!--end::Main-->

		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile</h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
                        @if(Auth::guard('admin')->user()->profile_image)
						    <div class="symbol-label" style="background-image:url('{{Auth::guard('admin')->user()->profile_image}}')"></div>
                        @else
                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                        @endif
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                            {{ Auth::guard('admin')->user()->name }}
                        </a>
						<div class="navi mt-2">
							<a href="{{ route('admin.logout') }}" title="Sign Out" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<!--begin::Nav-->
				<div class="navi navi-spacer-x-0 p-0">
					<a href="{{route('admin.edit-profile')}}" title="Edit Profile" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
                                        <img alt="My Profile" src="{{ url('admin/media/svg/icons/General/Notification2.svg') }}">
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">My Profile</div>
							</div>
						</div>
					</a>
                    <a href="{{route('admin.change.password')}}" title="Change Password" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
                                        <img alt="My Profile" src="{{ url('admin/media/svg/icons/General/Notification2.svg') }}">
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">Change Password</div>
							</div>
						</div>
					</a>
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
                <img src="{{ url('admin/media/svg/icons/Navigation/Up-2.svg') }}" alt="Scroll Top">
			</span>
		</div>
		<!--end::Scrolltop-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<script src="{{ url('/admin/') }}/plugins/global/plugins.bundle.js"></script>
		<script src="{{ url('/admin/') }}/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="{{ url('/admin/') }}/js/scripts.bundle.js"></script>
        <script type="text/javascript">
            var host = "<?php echo URL::to('/'); ?>";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
        </script>
        @if (\Session::has('success'))
            <script type="text/javascript">
                $(function() {
                    var msg = "{{\Session::get('success')}}";
                    toastr.success(msg, 'Success' , {timeOut: 5000});
                });
            </script>
        @elseif (\Session::has('error'))
            <script type="text/javascript">
                $(function() {
                    var msg = "{{\Session::get('error')}}";
                    toastr.info(msg, 'Error' , {timeOut: 5000});
                });
            </script>
        @endif
        @php
            $route_var = Route::current();
            $route_name = $route_var->getName();
        @endphp
        <script type="text/javascript">
        var _ROOT = "{{ asset('/') }}";
        var _ROUTE_NAME = "{{ $route_name }}";
        </script>
		<!--end::Global Theme Bundle-->
        {{ HTML::script('cms/js/admin.js') }}
        {{ HTML::script('vendor/jsvalidation/js/jsvalidation.js') }}

        @yield('script')
	</body>
</html>
