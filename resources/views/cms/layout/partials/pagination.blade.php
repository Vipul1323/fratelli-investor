<div class="d-flex justify-content-between align-items-center flex-wrap">
    
    <div class="d-flex align-items-center py-3">
        {!! Form::open(['method' => 'get','id'=>'filter_form']) !!}

        @php $pagination = Config::get('constants.pagination'); @endphp

        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('dir', $dir) }}

        <select onchange="this.form.submit()" name="deafult_ordering_table_length" aria-controls="deafult_ordering_table"  class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
            @if(!empty($deafult_ordering_table_length))
                @foreach($pagination as $key => $value)
                    @if($deafult_ordering_table_length == $value)
                        <option value="{{$value}}" selected>{{$value}}</option>
                    @else
                        <option value="{{$value}}">{{$value}}</option>
                    @endif
                @endforeach
            @else
                @foreach($pagination as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                @endforeach
            @endif
        </select>
        <span class="text-muted">Entries per page</span>
        {!! Form::close() !!}
    </div>

    @if ($paginator->hasPages())
        <div class="d-flex flex-wrap py-2 mr-3">
            <!-- Previous Page -->
            @if ($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm disabled border-0 btn-hover-primary mr-2 my-1 " >{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1 active" href="{{ $url }}#">{{ $page }}</a>
                    @else
                        <a class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1" href="{{ $url }}">{{ $page }}</a>
                    @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            @else
                <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
            @endif
        </div>
    @endif
    
</div>