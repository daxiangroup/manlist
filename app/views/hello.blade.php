@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'login.post')) }}

<div class="row">
	<div class="columns small-4 small-centered">
		{{ Form::label('password', 'Password', array('class'=>'text-center')) }}
		{{ Form::password('password', array('placeholder'=>'What\'s your password?')) }}
	</div>
</div>

<div class="row">
	<div class="columns small-4 small-centered">
		{{ Form::submit('Let\'s Go!', array('class'=>'button tiny radius')) }}
	</div>
</div>

{{ Form::close() }}
@stop
