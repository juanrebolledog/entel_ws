@extends('login_layout')

@section('content')
<section id="login-form">
    <section id="login-form-header">
        <h3>{{ 'Login' }}</h3>
    </section>
    <section id="login-form-content">
        {{ Form::open(array('url' => action('SuperAdminUsersController@login'))) }}
        {{ Form::label('email', 'Correo') }}
        {{ Form::text('email') }}

        {{ Form::label('password', 'Contraseña') }}
        {{ Form::password('password') }}
        {{ Form::submit('Entrar', array('class' => 'button tiny')) }}
        {{ Form::close() }}
    </section>
</section>
@stop