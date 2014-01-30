@extends('admin_layout')

@section('content')
<section>
	<header>
		<h3>
			{{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías de Zonas') }} &raquo; {{ link_to(action('AdminZoneCategoriesController@show', $category->id), $category->nombre) }} &raquo; {{ 'Editar' }}
		</h3>
	</header>
	{{ Form::model($category, array('url' => action('AdminZoneCategoriesController@update', $category->id), 'method' => 'put')) }}
	<fieldset>
		<legend>Informaci&oacute;n</legend>
		<div class="name-field">
			{{ Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre') }}
			@if ($errors->has('nombre'))
			<small class="error">{{ $errors->first('nombre') }}</small>
			@endif
		</div>
	</fieldset>
	{{ Form::submit('Guardar', array('class' => 'button')) }}
	{{ link_to(action('AdminZoneCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')) }}
	{{ Form::close() }}
</section>
@stop