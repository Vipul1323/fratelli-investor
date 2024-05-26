@extends('cms.layout.app')

@section('htmlheader_title', "About Us Content")

@section('module', "About Us Content")

@section('content')
    <div class="card card-custom gutter-b">
        {!! Form::open([
            'url' => '/admin/settings/about-us',
            'class' => 'form',
            'id' => 'update-about-us-settings',
            'files' => false
        ]) !!}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('youtube_video_link', 'Youtube Video Link') !!}
                        {{ Form::text('youtube_video_link', empty($siteSettings->youtube_video_link) ? '' : $siteSettings->youtube_video_link, array('id'=>'youtube_video_link','class' => 'form-control','placeholder'=>'Youtube Video Link')) }}
                    </div>
                </div>
                <div class="separator separator-solid mt-8 mb-5"></div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        {!! Form::label('title', 'Title') !!}
                        {{ Form::text('title', empty($settings->title) ? '' : $settings->title, array('id'=>'title','class' => 'form-control','placeholder'=>'Title')) }}
                    </div>
                    <div class="col-lg-12 mt-5">
                        {!! Form::label('description', 'Description') !!}
                        {{ Form::textarea('description', empty($settings->description) ? '' : $settings->description, array('id'=>'description','class' => 'form-control','placeholder'=>'Description')) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Update Settings',['class' => 'btn btn-sm btn-primary','id' => 'signup-first-form-submit']) !!}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('script')
    {!! $validator->selector('#update-about-us-settings') !!}
@endsection
