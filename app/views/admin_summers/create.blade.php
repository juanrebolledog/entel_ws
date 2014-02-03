@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSummersController@index'), 'Veranos') }} &raquo; Crear Nuevo
        </h3>
    </header>
    {{ Form::model($summer, array('url' => action('AdminSummersController@store'), 'files' => true)) }}
        <fieldset>
            <legend>Informaci&oacute;n B&aacute;sica</legend>
            <div class="name-field">
                 {{ Form::label('nombre', 'Nombre') }}
                 {{ Form::text('nombre') }}
                 @if ($errors->has('nombre'))
                    <small class="error"> {{ $errors->first('nombre') }}</small>
                 @endif
            </div>

             {{ Form::label('descripcion', 'Descripción') }}
             {{ Form::textarea('descripcion') }}
             @if ($errors->has('descripcion'))
                <small class="error"> {{ $errors->first('descripcion') }}</small>
             @endif

             {{ Form::label('descripcion_larga', 'Descripción Larga') }}
             {{ Form::textarea('descripcion_larga') }}
             @if ($errors->has('descripcion_larga'))
                <small class="error"> {{ $errors->first('descripcion_larga') }}</small>
             @endif

             {{ Form::label('texto_beneficio', 'Texto Beneficio') }}
             {{ Form::textarea('texto_beneficio') }}
             @if ($errors->has('texto_beneficio'))
                <small class="error"> {{ $errors->first('texto_beneficio') }}</small>
             @endif

             {{ Form::label('legal', 'Bases Legales') }}
             {{ Form::textarea('legal') }}
             @if ($errors->has('legal'))
                <small class="error"> {{ $errors->first('legal') }}</small>
             @endif

             {{ Form::label('fecha', 'Fecha') }}
	         {{ Form::input('date', 'fecha') }}
             @if ($errors->has('fecha'))
                <small class="error"> {{ $errors->first('fecha') }}</small>
             @endif

             {{ Form::label('categoria_id', 'Categoría') }}
             {{ Form::select('categoria_id', $categories) }}
             @if ($errors->has('categoria_id'))
                <small class="error"> {{ $errors->first('categoria_id') }}</small>
             @endif
        </fieldset>
        <fieldset>
            <legend>Ubicaci&oacute;n</legend>
             {{ Form::label('lugar', 'Lugar') }}
             {{ Form::text('lugar') }}
             @if ($errors->has('lugar'))
                <small class="error"> {{ $errors->first('lugar') }}</small>
             @endif

	         {{ Form::label('horario', 'Horario') }}
	         {{ Form::text('horario') }}
	         @if ($errors->has('horario'))
		        <small class="error"> {{ $errors->first('horario') }}</small>
	         @endif
        </fieldset>
        <fieldset>
            <legend>SMS</legend>
             {{ Form::label('sms_texto', 'Texto') }}
             {{ Form::text('sms_texto') }}
             @if ($errors->has('sms_texto'))
                <small class="error"> {{ $errors->first('sms_texto') }}</small>
             @endif

             {{ Form::label('sms_nro', 'Número') }}
             {{ Form::text('sms_nro') }}
             @if ($errors->has('sms_nro'))
                <small class="error"> {{ $errors->first('sms_nro') }}</small>
             @endif
        </fieldset>
        <fieldset>
            <legend>Im&aacute;genes</legend>
	         {{ Form::label('imagen_descripcion', 'Descripción') }}
	         {{ Form::file('imagen_descripcion') }}
	         @if ($errors->has('imagen_descripcion'))
		        <small class="error"> {{ $errors->first('imagen_descripcion') }}</small>
	         @endif

	         {{ Form::label('imagen_titulo', 'Título') }}
	         {{ Form::file('imagen_titulo') }}
	         @if ($errors->has('imagen_titulo'))
		        <small class="error"> {{ $errors->first('imagen_titulo') }}</small>
	         @endif
        </fieldset>
        {{ Form::submit('Guardar', array('class' => 'button')) }}
        {{ link_to(action('AdminSummersController@index'), 'Cancelar', array('class' => 'button secondary')) }}
    {{ Form::close() }}
</section>
@stop