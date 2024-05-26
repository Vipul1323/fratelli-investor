<div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        </div>
        <div class="topbar">
            <!--begin::Languages-->
            <!-- <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm" src="{{ url('/admin/') }}/media/svg/flags/226-united-states.svg" alt="" />
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ url('/admin/') }}/media/svg/flags/226-united-states.svg" alt="" />
                                </span>
                                <span class="navi-text">English</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!--end::Languages-->

            <!--begin::User-->
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::guard('admin')->user()->name }}</span>
                    @if(Auth::guard('admin')->user()->profile_image)
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                            <span class="symbol-label" style="background-image:url('{{Auth::guard('admin')->user()->profile_image}}')"></span>
                        </span>
                    @else
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                        </span>
                    @endif
                </div>
            </div>
            <!--end::User-->
        </div>
    </div>
</div>