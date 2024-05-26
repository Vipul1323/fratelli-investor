<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <ul class="navigation-left">

            <li class="nav-item" ><a class="nav-item-hold" data-name="admin.dashboard" href="{{ route('admin.dashboard') }}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                <div class="triangle"></div>
            </li>

            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.list-subadmin'))
                <li class="nav-item" ><a class="nav-item-hold" data-name="subadmin" href="{{ route('admin.list-subadmin') }}"><i class="nav-icon i-Add-User"></i><span class="nav-text">Sub Admin</span></a>
                    <div class="triangle"></div>
                </li>
            @endif

            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.list-users'))
                <li class="nav-item" ><a class="nav-item-hold" data-name="users" href="{{ route('admin.list-users') }}"><i class="nav-icon i-Add-User"></i><span class="nav-text">Users</span></a>
                    <div class="triangle"></div>
                </li>
            @endif


            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.list-emailtemplates'))
            <li class="nav-item" ><a class="nav-item-hold" data-name="emailtemplates" href="{{ route('admin.list-emailtemplates') }}"><i class="nav-icon i-Email" aria-hidden="true"></i><span class="nav-text px-2">Email Templates</span></a>
                <div class="triangle"></div>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.list-staticpages'))
            <li class="nav-item" ><a class="nav-item-hold" data-name="staticpages" href="{{ route('admin.list-staticpages') }}"><i class="nav-icon fa fa-file-o" aria-hidden="true"></i><span class="nav-text px-2">Static Pages</span></a>
                <div class="triangle"></div>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.list-contactus'))
            <li class="nav-item" ><a class="nav-item-hold" data-name="contactus" href="{{ route('admin.list-contactus') }}"><i class="nav-icon fa fa-address-book-o" aria-hidden="true"></i><span class="nav-text px-2">Contact Us</span></a>
                <div class="triangle"></div>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.settings-mail'))
            <li class="nav-item" ><a class="nav-item-hold" data-name="mail" href="{{ route('admin.settings-mail') }}"><i class="nav-icon fa fa-gear" aria-hidden="true"></i><span class="nav-text px-2">Settings</span></a>
                <div class="triangle"></div>
            </li>
            @endif
        </ul>
    </div>

    <!-- Submenu Dashboards-->
    {{-- <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">

        <ul class="childNav" data-parent="dashboard">
            <li class="nav-item"><a href="dashboard1.html"><i class="nav-icon i-Clock-3"></i><span class="item-name">Version 1</span></a></li>
            <li class="nav-item"><a href="dashboard2.html"><i class="nav-icon i-Clock-4"></i><span class="item-name">Version 2</span></a></li>
            <li class="nav-item"><a href="dashboard3.html"><i class="nav-icon i-Over-Time"></i><span class="item-name">Version 3</span></a></li>
            <li class="nav-item"><a href="dashboard4.html"><i class="nav-icon i-Clock"></i><span class="item-name">Version 4</span></a></li>
        </ul>
    </div> --}}
    <div class="sidebar-overlay"></div>
</div>