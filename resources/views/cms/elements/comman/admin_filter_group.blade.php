{!! Form::open(array('route' => $url, 'method' => 'get' , 'class' => 'form-add', 'id'=>'filters')) !!}
    <div class="row">
        <div class="col-md-3 form-group mb-3">
            {!! Form::label('search', 'Search') !!}
            {!! Form::text('search', empty($search) ? '' : $search, ['class' => 'form-control form-control-sm filterrules','placeholder' => 'Search','autocomplete'=>"off"]) !!}
            <div class="text-muted">{{$tips}}</div>
        </div>
        <input type="hidden" name="from_date" id="from_date">
        <input type="hidden" name="to_date" id="to_date">

        <div class="col-md-3 form-group mb-3">
            {!! Form::label('registered', 'Created Between') !!}
            {!! Form::text('registered', empty($registered) ? '' : $registered, ['class' => 'form-control form-control-sm filterrules', 'id' => 'registered','placeholder' => 'Select Created Date','autocomplete'=>"off"]) !!}
        </div>

        @if(Route::current()->getName() == 'admin.list-contactus')
        <div class="col-md-3 form-group mb-3">
            {!! Form::label('filter_by_status', 'Status') !!}
            {!! Form::select('filter_by_status', $status, empty($filter_by_status) ? '' : $filter_by_status, ['id' => 'contact_status','class' => 'custom-select form-control-sm filterrules need-selectwith','placeholder' => 'Select Status','autocomplete'=>"off"]) !!}
        </div>
        @endif
    </div>

    <div class="clearfix"></div>
    <div class="col-md-6 pl-0 pr-0">
        <button class="btn btn-sm btn-primary">Filter</button>
            <?php if(!empty($_GET)){ ?>
                <button class="btn btn-sm btn-outline-dark m-1 resetbtn">Clear</button>
            <?php } ?>
    </div>

{{ Form::close() }}

@section('script')
    {{ HTML::script('admin/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}

    <script type="text/javascript">
        $(document).ready(function () {
            $('#registered').daterangepicker({
                buttonClasses: ' btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary'
            });

            $('#registered').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                $("#from_date").attr('value',picker.startDate.format('YYYY-MM-DD'));
                $("#to_date").attr('value',picker.endDate.format('YYYY-MM-DD'));
            });

            $('#registered').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('.resetbtn').click(function(e){
                window.location.href = '{{ route("$url") }}';
                e.preventDefault();
            });

            if ($('#changeStatusModal').length)
            {
                $('#changeStatusModal').on('show.bs.modal', function () {
                    loadComments($("#inquiry_id").val());
                });

                $('#changeStatusModal').on('hidden.bs.modal', function () {
                    $(this).find('form')[0].reset();
                });

                $(".changeStatus").on("click",function(){
                    $("#status_id").val($(this).data('status'));
                    $("#inquiry_id").val($(this).data('id'));
                });
            }
        });

        if ($('#changeStatusModal').length){
            function loadComments(inquiry_id) {
                $("#comments_section").html("");
                $.ajax({
                url : _ROOT+'admin/enquiry-comments',
                type : 'POST',
                data : {id:inquiry_id},
                success:function(data){
                    if(data){
                        $("#comments_section").html(data);
                    }
                },
                error:function(data) {
                }
            });
            }
        }
    </script>
@endsection