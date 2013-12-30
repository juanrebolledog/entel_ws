@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Mi Perfil' }}
        </h3>
        <ul>
            <li>
                <a href="#">{{ 'Editar Perfil' }}</a>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item entel-item-light">
                <header>{{ 'Detalles' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Correo' }}</dt>
                        <dd>
                            {{ $user->email; }}
                        </dd>
                        <dt>{{ 'Último login' }}</dt>
                        <dd>
                            &nbsp;
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop