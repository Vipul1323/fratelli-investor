@extends('cms.layout.app')

@section('htmlheader_title', 'Folders')

@section('module', 'Folders')

@if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.folders.create'))
    @section('btnname', 'Add New Folder')
    @section('add_action', route('admin.folders.create'))
@endif

@section('pathway')
    <li class="breadcrumb-item">List</li>
@endsection

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="col-md-12 mb-3 pl-0 pr-0">
                @include('elements.comman.admin_filter_group',['url' => 'admin.folders.index','tips' => 'Search by folder name'])
            </div>
            <div class="col-md-12 mb-3 pl-0 pr-0">
                <table class="table table-bordered table-responsive-lg">
                    <thead class="thead-dark">
                        <tr>
                            @sortable('id','#',$order,$dir,route('admin.folders.index')."?order=id&dir={$dir}&deafult_ordering_table_length={$deafult_ordering_table_length}")
                            @sortable('name','Folder Name',$order,$dir,route('admin.folders.index')."?order=name&dir={$dir}&deafult_ordering_table_length={$deafult_ordering_table_length}")
                            <th scope="col">Parent</th>
                            <th scope="col">Sub Folders</th>
                            @sortable('created_at','Created On',$order,$dir,route('admin.folders.index')."?order=created_at&dir={$dir}&deafult_ordering_table_length={$deafult_ordering_table_length}")
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($folders as $folder)
                            <tr>
                                <td>{{ $folder->id }}</td>
                                <td>
                                    <div class="ul-widget_user-card">
                                        <div class="ul-widget4__img">
                                            {{$folder->name}}
                                        </div>
                                    </div>
                                </td>
                                <td>{{$folder->parent_id}}</td>
                                <td>
                                    @if((Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.folders.index')) && count($folder->children) > 0)
                                        <a class="btn btn-icon btn-sm btn-circle m-1 btn-light-info mr-1" title="View Sub Folder" href="{{route('admin.folders.index',"parent_id=".$folder->id)}}"><i class="fa far fa-eye"></i></a>
                                    @endif
                                </td>
                                <td>{{$folder->created_date}}</td>
                                <td>
                                    {{-- @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.folders.index'))
                                        <a class="btn btn-icon btn-sm btn-circle m-1 btn-light-info mr-1" title="View Folder" href="{{route('admin.folders.index',"parent_id=".$folder->id)}}"><i class="fa far fa-eye"></i></a>
                                    @endif --}}

                                    @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.folders.edit'))
                                        <a class="btn btn-icon btn-sm btn-circle m-1 btn-light-warning mr-1" title="View Folder" href="{{route('admin.folders.edit',$folder->id)}}"><i class="fa far fa-edit"></i></a>
                                    @endif

                                    @if(Auth::guard('admin')->user()->hasRole('superadministrator') || Auth::guard('admin')->user()->isAbleTo('admin.folders.edit'))
                                        <a class="btn btn-icon btn-sm btn-circle m-1 btn-light-danger mr-1" title="View Folder" href="{{route('admin.folders.delete',$folder->id)}}"><i class="fa far fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $folders->appends($page_appends)->links('cms.layout.partials.pagination',['order' => $order,'dir' => $dir,'deafult_ordering_table_length' => $deafult_ordering_table_length]) }}
        </div>
    </div>
@endsection
