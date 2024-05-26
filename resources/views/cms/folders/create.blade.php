@extends('cms.layout.app')

@php
    $title = "Create";
@endphp

@section('htmlheader_title', "$title Folder")
@section('module', "$title Folder")

@section('style')
<link href="{{ url('admin/plugins/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
<style>
    .jstree-default .jstree-clicked {
        background: #F29F67 !important;
    }
</style>
@endsection

@section('pathway')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.folders.index') }}" title="List" class="text-muted">List</a>
    </li>
    <li class="breadcrumb-item text-muted">{{ $title }}</li>
@endsection

@section('content')
    <div class="card card-custom gutter-b">
        {!! Form::open(array('route' => ['admin.folders.create']  , 'class' => 'form', 'id'=>'create', 'files'=>true)) !!}
            <div class="card-body">
                <input type="hidden" name="parent_id" id="parent_id">
                <div class="row">
                    <div class="col-lg-5">
                        {!! Form::label('', 'Root Folder') !!}
                        <div id="kt_tree_1" class="tree-demo">{!! $options !!}</div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::label('folder_name', 'Folder Name') !!}
                                {!! Form::text('folder_name', "", ['class' => 'form-control','placeholder' => 'Enter Folder Name' ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Save',['class' => 'btn btn-sm btn-primary','id' => 'signup-first-form-submit']) !!}
                <a href="{{ route('admin.folders.index') }}" class="btn btn-sm btn-outline-dark m-1" type="button">Cancel</a>
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('script')
    <script src="{{ url('admin/plugins/custom/jstree/jstree.bundle.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#kt_tree_1").jstree({
                "core": {
                    "themes": {
                        "responsive": true
                    }
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder"
                    },
                    "file": {
                        "icon": "fa fa-file"
                    }
                },
                "plugins": ["types"]
            });

            $('#kt_tree_1').on('select_node.jstree', function(e, data) {
                $('#parent_id').val(data.node.id)
            });

        });
    </script>
@endsection
