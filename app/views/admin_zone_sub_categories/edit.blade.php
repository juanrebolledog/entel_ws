@extends('admin_layout')

@section('content')
<section>
	<header>
		<h3>
			{{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías de Zonas') }} &raquo; {{ link_to(action('AdminZoneCategoriesController@show', $category->id), $category->nombre) }} &raquo; {{ link_to(action('AdminZoneSubCategoriesController@show', array($category->id, $sub_category->id)), $sub_category->nombre) }} &raquo; {{ 'Editar' }}
		</h3>
	</header>
	{{ Form::model($sub_category, array('url' => action('AdminZoneSubCategoriesController@update', array($category->id, $sub_category->id)), 'method' => 'put', 'files' => true)) }}
	<fieldset>
		<legend>Informaci&oacute;n</legend>
		<div class="name-field">
			{{ Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre') }}
			@if ($errors->has('nombre'))
			<small class="error">{{ $errors->first('nombre') }}</small>
			@endif
		</div>

		{{ Form::label('padre_id', 'Categoría') }}
		{{ Form::select('padre_id', $categories, $category->id) }}
		@if ($errors->has('padre_id'))
		<small class="error">{{ $errors->first('padre_id') }}</small>
		@endif

		{{ Form::label('imagen_icono', 'Ícono') }}
		{{ Form::file('imagen_icono') }}
		@if ($errors->has('imagen_icono'))
		<small class="error">{{ $errors->first('imagen_icono') }}</small>
		@endif
	</fieldset>
	{{ Form::submit('Guardar', array('class' => 'button')) }}
	{{ link_to(action('AdminZoneCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')) }}
	{{ Form::close() }}
</section>
@stop