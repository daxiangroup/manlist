@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'login.post', 'id' => 'form-login')) }}

<div class="row ctr-login">
    <div class="columns small-4 small-centered">
        {{ Form::submit('Let\'s Go!', array('id'=>'button-login', 'class'=>'button tiny radius')) }}
        {{ Form::password('password', array('placeholder'=>'What is your password?')) }}
    </div>
</div>

<div class="row">
    <div class="columns small-6 small-offset-3 navigation">
        <div id="alert-messages" data-alert class="ctr-login alert-box warning radius alert-messages">
            <span>This is an info alert with a radius.</span>
            Click to dismiss
        </div>
    </div>
</div>

{{ Form::close() }}

<script>
$(document).ready(function() {
    setTimeout(function() {
        $('input[type="password"]').focus();
    }, 1000);
});
</script>
@stop
