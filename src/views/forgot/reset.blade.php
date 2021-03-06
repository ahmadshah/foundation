@extends('orchestra/foundation::layout.extra')

<?php

use Illuminate\Support\Facades\Input;
use Orchestra\Support\Facades\Form;
use Orchestra\Support\Facades\Site; ?>

@section('content')
<div class="row">
	<div class="six columns offset-by-three">
		{{ Form::open(array('url' => handles("orchestra::forgot/reset"), 'method' => 'POST', 'class' => 'form-horizontal')) }}
			<input type="hidden" name="token" value="{{ $token }}">
			<fieldset>
				<div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
					{{ Form::label('email', trans('orchestra/foundation::label.users.email'), array('class' => 'three columns control-label')) }}
					<div class="nine columns">
						{{ Form::input('email', 'email', Input::old('email'), array('required' => true, 'class' => 'form-control')) }}
						{{ $errors->first('email', '<p class="help-block">:message</p>') }}
					</div>
				</div>
				<div class="form-group{{ $errors->has('password') ? ' error' : '' }}">
					{{ Form::label('password', trans('orchestra/foundation::label.users.password'), array('class' => 'three columns control-label')) }}
					<div class="nine columns">
						{{ Form::password('password', array('required' => true, 'class' => 'form-control')) }}
						{{ $errors->first('password', '<p class="help-block">:message</p>') }}
					</div>
				</div>
				<div class="form-group{{ $errors->has('password_confirmation') ? ' error' : '' }}">
					{{ Form::label('password_confirmation', trans('orchestra/foundation::label.account.confirm_password'), array('class' => 'three columns control-label')) }}
					<div class="nine columns">
						{{ Form::password('password_confirmation', array('required' => true, 'class' => 'form-control')) }}
						{{ $errors->first('password_confirmation', '<p class="help-block">:message</p>') }}
					</div>
				</div>
				<div class="row">
					<div class="nine columns offset-by-three">
						<button type="submit" class="btn btn-primary">{{ Site::get('title', 'Submit') }}</button>
					</div>
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
@stop
