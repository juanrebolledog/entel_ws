@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSummerCategoriesController@index'), 'Categorías de Veranos') }} &raquo; Crear Nueva
        </h3>
    </header>
    {{ Form::model($category, array('url' => action('AdminSummerCategoriesController@store'))) }}
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
        {{ link_to(action('AdminSummerCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')) }}
    {{ Form::close() }}
</section>
@stop