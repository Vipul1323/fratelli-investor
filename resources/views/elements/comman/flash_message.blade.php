<?php
/**
 * Flash Message
 * This is used for display flash messages
 */
?>

@if (count($errors) > 0)
    <div class="alert custom-flash-message alert-danger">
        <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::has('success'))
    <div class="alert custom-flash-message alert-success" onclick="this.classList.add('hidden');">
        {{ \Session::get('success') }}
    </div>
@elseif (\Session::has('error'))
    <div class="alert custom-flash-message alert-danger" onclick="this.classList.add('hidden');">
        {{ \Session::get('error') }}
    </div>
@endif