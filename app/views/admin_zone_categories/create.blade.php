@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías de Zonas') }} &raquo; Crear Nueva
        </h3>
    </header>
    {{ Form::model($category, array('url' => action('AdminZoneCategoriesController@store'), 'files' => true)) }}
        <fieldset>
            <legend>Informaci&oacute;n</legend>
            <div class="name-field">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre') }}
                @if ($errors->has('nombre'))
                    <small class="error">{{ $errors->first('nombre') }}</small>
                @endif
            </div>

	        {{ Form::label('imagen_fondo', 'Fondo') }}
	        {{ Form::file('imagen_fondo') }}
	        @if ($errors->has('imagen_fondo'))
	        <small class="error">{{ $errors->first('imagen_fondo') }}</small>
	        @endif
        </fieldset>
        {{ Form::submit('Guardar', array('class' => 'button')) }}
        {{ link_to(action('AdminZoneCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')) }}
    {{ Form::close() }}
</section>
@stop