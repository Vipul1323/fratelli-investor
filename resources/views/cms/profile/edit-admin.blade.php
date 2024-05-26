@extends('cms.layout.app')

@section('htmlheader_title', "Edit Profile")

@section('module', "Edit Profile")

@section('content')
    <div class="card card-custom gutter-b">
        {{ Form::model($user,array('class' => 'form','id'=>'editAdminForm','files'=>true)) }}
            <div class="card-body">
                {{ Form::hidden('role_id', env('USER_ROLE',4)) }}
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('image', 'Image',['class' => 'w-100']) !!}
                        <div class="img-preview">
                            <img src="{{$user->profile_image}}" class="rounded-circle" id="need-preview" width="100" height="100" alt="User Profile Image" />
                        </div>
                        <label class="fileContainer">
                            {{ Form::file('profile_picture',['id'=>'img-upload']) }}
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('email', 'Email') !!}
                        <span class="font-weight-bold">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('first_name', 'First Name') !!}
                        {!! Form::text('first_name', empty($user->first_name) ? '' : $user->first_name, ['class' => 'form-control','placeholder' => 'Enter User First Name' ]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', empty($user->last_name) ? '' : $user->last_name, ['class' => 'form-control','placeholder' => 'Enter User Last Name' ]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {!! Form::label('gender', 'Gender') !!}
                        <div class="radio-inline">
                            @php $gender = Config::get('constants.gender'); @endphp
                            @foreach($gender as $key => $value)
                                @if ($key != $user->gender)
                                    <label class="radio radio-solid">
                                        <input type="radio" value="{{$key}}" name="gender"/>
                                        <span></span>
                                        {{$value}}
                                    </label>
                                @else
                                    <label class="radio radio-solid">
                                        <input type="radio" value="{{$key}}" checked="checked" name="gender"/>
                                        <span></span>
                                        {{$value}}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Update',['class' => 'btn btn-sm btn-primary','id' => 'signup-first-form-submit']) !!}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('script')
    {!! $validator->selector('#editAdminForm') !!}
@endsection
