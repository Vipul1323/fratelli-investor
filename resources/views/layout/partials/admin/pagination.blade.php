<div class="d-flex justify-content-between">
    {!! Form::open(['method' => 'get','id'=>'filter_form']) !!}
    <div class="records_per_page">
        <?php
            $pagination = Config::get('constants.pagination');
        ?>

        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('dir', $dir) }}

        <select onchange="this.form.submit()" name="deafult_ordering_table_length" aria-controls="deafult_ordering_table" class="form-control form-control-sm">
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
        <label class="text-muted"> Entries per page</label>
    </div>
    {!! Form::close() !!}

@if ($paginator->hasPages())
    <ul class="pagination">
        <!-- Previous Page -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}#" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0);" >{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="{{ $url }}#" >{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page -->
        @if ($paginator->hasMorePages())
            <li class="page-item disabled">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}#" aria-label="Next">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @endif
    </ul>
@endif
</div>
