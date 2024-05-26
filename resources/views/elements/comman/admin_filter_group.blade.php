{!! Form::open(array('route' => $url, 'method' => 'get' , 'class' => 'form-add', 'id'=>'filters')) !!}
    <div class="row">
        @if(Route::current()->getName() == 'admin.list-transaction')
            <div class="col-md-3 form-group mb-3">
                {!! Form::label('user', 'User') !!}
                {!! Form::select('user',$users, empty($user) ? '' : $user, ['class' => 'form-control form-control-sm filterrules','placeholder' => 'Select User' ]) !!}
            </div>
        @else
            <div class="col-md-3 form-group mb-3">
                {!! Form::label('search', 'Search') !!}
                {!! Form::text('search', empty($search) ? '' : $search, ['class' => 'form-control form-control-sm filterrules','placeholder' => 'Search','autocomplete'=>"off"]) !!}
                <div class="text-muted">{{$tips}}</div>
            </div>
        @endif
        <input type="hidden" name="from_date" id="from_date">
        <input type="hidden" name="to_date" id="to_date">

        <div class="col-md-3 form-group mb-3">
            {!! Form::label('registered', 'Created Between') !!}
            {!! Form::text('registered', empty($registered) ? '' : $registered, ['class' => 'form-control form-control-sm filterrules','placeholder' => 'Select Created Date','autocomplete'=>"off"]) !!}
        </div>

        @if(Route::current()->getName() == 'admin.list-contactus')
        <div class="col-md-3 form-group mb-3">
            {!! Form::label('filter_by_status', 'Status') !!}
            {!! Form::select('filter_by_status', $status, empty($filter_by_status) ? '' : $filter_by_status, ['id' => 'contact_status','class' => 'custom-select form-control-sm filterrules need-selectwith','placeholder' => 'Select Status','autocomplete'=>"off"]) !!}
        </div>
        @endif
        <div class="col-md-3 mb-3 mt-7">
            <button class="btn btn-sm btn-primary">Filter</button>
            <?php if(!empty($_GET)){ ?>
                <button class="btn btn-sm btn-outline-dark m-1 resetbtn">Clear</button>
            <?php } ?>
        </div>
    </div>


{{ Form::close() }}

@section('js_script')
{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('vendor/daterangepicker/moment.min.js') }}
{{ HTML::style('vendor/daterangepicker/daterangepicker.css') }}
{{ HTML::script('vendor/daterangepicker/daterangepicker.js') }}

<script type="text/javascript">
    $(document).ready(function () {
        $('#registered').daterangepicker({
            autoUpdateInput: false,
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

if ($('#changeStatusModal').length)
{
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