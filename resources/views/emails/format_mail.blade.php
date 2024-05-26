@extends('emails.layouts.email',['dir'=> isset($dir)?$dir:'ltr'])

@section('content')
		
    {!! $user['email_body'] !!}
        
@stop