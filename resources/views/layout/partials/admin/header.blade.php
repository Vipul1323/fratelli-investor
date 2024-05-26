<div class="main-header">
    <div class="logo">
        <img src="{{ url('cms/image/logo.png') }}" alt="logo">
    </div>
    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>
    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <!--  asset(env('AWS_URL').Auth::guard('admin')->user()->image)  -->

                @if(Auth::guard('admin')->user()->profile_image)
                <img src="{{Auth::guard('admin')->user()->profile_image }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @else
                <img src="{{ url('img/avatar_simple_visitor.png') }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @endif

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::guard('admin')->user()->name }}
                    </div>
                    <a class="dropdown-item" href="{{route('admin.edit.admin')}}">Edit Profile</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</div>