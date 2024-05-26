<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@yield('module', '')</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                @yield('pathway')
            </ul>
        </div>
        
        <div class="d-flex align-items-center">
            @hasSection('btnname')
            <a href="@yield('add_action', '')" title="@yield('btnname', '')" class="btn btn-light-primary font-weight-bolder btn-sm">
                @yield('btnname', '')
            </a>
            @endif
        </div>
    </div>
</div>