<!-- REQUIRED JS SCRIPTS -->

<?php
    $route_var = Route::current();
    $route_name = $route_var->getName();
?>
<script type="text/javascript">
var _ROOT = "{{ asset('/') }}";
var _ROUTE_NAME = "{{ $route_name }}";
</script>



{{ HTML::script('js/bootstrap.bundle.min.js') }}
{{ HTML::script('vendor/jsvalidation/js/jsvalidation.js') }}
{{ HTML::script('cms/js/plugins/perfect-scrollbar.min.js') }}
{{ HTML::script('cms/js/script.min.js') }}
{{ HTML::script('cms/js/sidebar.large.script.min.js') }}
{{ HTML::script('cms/js/toastr.min.js') }}
{{ HTML::script('cms/js/admin.js') }}
{{ HTML::script('cms/js/select2.min.js') }}

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

<script type="text/javascript">
    var host = "<?php echo URL::to('/'); ?>";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
</script>