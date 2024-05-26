<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript">
var _ROOT = "{{ asset('/') }}";
</script>

{{ HTML::script('js/jquery-3.4.1.min.js') }}
{{ HTML::script('js/bootstrap.bundle.min.js') }}
{{ HTML::script('vendor/jsvalidation/js/jsvalidation.js') }}
{{ HTML::script('cms/js/toastr.min.js') }}

@if (\Session::has('success'))
    
@elseif (\Session::has('error'))
     
@endif

<script type="text/javascript">
    var host = "<?php echo URL::to('/'); ?>";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
</script>