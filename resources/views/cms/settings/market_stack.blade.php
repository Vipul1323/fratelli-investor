@extends('cms.layout.app')

@section('htmlheader_title', "Market Stack API Settings")

@section('module', "Market Stack API Settings")

@section('content')
    <div class="card card-custom gutter-b">
        {!! Form::open([
            'url' => '/admin/settings/market-api',
            'class' => 'form',
            'id' => 'update-market-api-settings',
            'files' => false
        ]) !!}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-8 mt-5">
                        {!! Form::label('marketstack_key', 'API Access Key') !!}
                        {{ Form::text('marketstack_key', empty($settings->marketstack_key) ? '' : $settings->marketstack_key, array('id'=>'marketstack_key','class' => 'form-control','placeholder'=>'API Access Key')) }}
                    </div>
                    <div class="col-lg-8 mt-5">
                        {!! Form::label('marketstack_endpoint', 'API Endpoint') !!}
                        {{ Form::text('marketstack_endpoint', empty($settings->marketstack_endpoint) ? '' : $settings->marketstack_endpoint, array('id'=>'marketstack_endpoint','class' => 'form-control','placeholder'=>'API Endpoint')) }}
                    </div>
                    <div class="col-lg-8 mt-5">
                        {!! Form::label('api_call_per_minute', 'API Call Interval (in minutes)') !!}
                        {{ Form::text('api_call_per_minute', empty($settings->api_call_per_minute) ? '' : $settings->api_call_per_minute, array('id'=>'api_call_per_minute','class' => 'form-control','placeholder'=>'API Call Per Minute')) }}
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
    {!! $validator->selector('#update-market-api-settings') !!}
@endsection
