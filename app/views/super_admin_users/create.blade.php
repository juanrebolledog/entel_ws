@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('SuperAdminUsersController@index'), 'Usuarios Admin') }} &raquo; Crear Nuevo
        </h3>
    </header>
    {{ Form::model($user, array('url' => action('SuperAdminUsersController@store'))); }}
        <fieldset>
            <legend>{{ 'Detalles' }}</legend>
            <div class="name-field">
                {{ Form::label('email', 'Correo') }}
                {{ Form::text('email') }}
                @if ($errors->has('email'))
                    <small class="error">{{ $errors->first('email') }}</small>
                @endif
            </div>

            {{ Form::label('password', 'Contraseña') }}
            {{ Form::password('password') }}
            @if ($errors->has('password'))
                <small class="error">{{ $errors->first('password') }}</small>
            @endif

            {{ Form::label('password_confirmation', 'Contraseña (confirmación)') }}
            {{ Form::password('password_confirmation') }}
            @if ($errors->has('password_confirmation'))
                <small class="error">{{ $errors->first('password_confirmation') }}</small>
            @endif
        </fieldset>

        {{ Form::submit('Guardar', array('class' => 'button')) }}
        {{ link_to(action('SuperAdminUsersController@index'), 'Cancelar', array('class' => 'button secondary')) }}
    {{ Form::close() }}
</section>
@stop