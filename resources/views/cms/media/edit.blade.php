@extends('cms.layout.app')

@php
    $title = "Upload";
@endphp

@section('htmlheader_title', "$title File")

@section('module', "$title File")

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
        <a href="{{ route('admin.media.index') }}" title="List" class="text-muted">List</a>
    </li>
    <li class="breadcrumb-item text-muted">{{ $title }}</li>
@endsection

@section('content')
    <div class="card card-custom gutter-b">
        {!! Form::open(array('route' => ['admin.media.edit',$mediaObj->id]  , 'class' => 'form', 'id'=>'create', 'files'=>true)) !!}
            <div class="card-body">
                <input type="hidden" name="folder_id" id="folder_id" value="{{ $mediaObj->folder_id }}">
                <div class="row">
                    <div class="col-lg-5">
                        {!! Form::label('', 'Root Folder') !!}
                        <div id="kt_tree_1" class="tree-demo">{!! $options !!}</div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                {!! Form::label('filename', 'File Name') !!}
                                {!! Form::text('filename', $mediaObj->filename, ['class' => 'form-control','placeholder' => 'Enter file Name' ]) !!}
                            </div>

                            <div class="col-lg-12 form-group">
                                {!! Form::label('media_file', 'File') !!}
                                {!! Form::file('media_file',['class' => 'form-control','placeholder' => 'Select File' ]) !!}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Save',['class' => 'btn btn-sm btn-primary','id' => 'signup-first-form-submit']) !!}
                <a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-dark m-1" type="button">Cancel</a>
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
                $('#folder_id').val(data.node.id)
            });

        });
    </script>
@endsection
