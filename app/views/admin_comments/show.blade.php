@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminBenefitCommentsController@index'), 'Comentarios'); }} &raquo; en {{ $comment->benefit->nombre; }} en fecha {{ $comment->created_at }} (id: {{ $comment->id }})
        </h3>
        <ul>
            <li>
                <a href="#">Desactivar</a>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item entel-item-light">
                <header>{{ 'Comentario' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Usuario' }}</dt>
                        <dd>
                            {{ link_to(action('AdminUsersController@show', $comment->usuario_id), $comment->user->nombres) }}
                        </dd>
                        <dt>{{ 'Beneficio' }}</dt>
                        <dd>
                            {{ link_to(action('AdminBenefitsController@show', $comment->beneficio_id), $comment->benefit->nombre) }}
                        </dd>
                        <dt>{{ 'Mensaje' }}</dt>
                        <dd>
                            {{ $comment->mensaje }}
                        </dd>
                        <dt>{{ 'Compartido en Facebook' }}</dt>
                        <dd>
                            {{ $comment->compartido_fb ? 'Si':'No' }}
                        </dd>
                        <dt>{{ 'Compartido en Twitter' }}</dt>
                        <dd>
                            {{ $comment->compartido_tw ? 'Si':'No' }}
                        </dd>
                        <dt>{{ 'Creado en' }}</dt>
                        <dd>
                            {{ $comment->created_at }}
                        </dd>
                    </dl>
                </div>
            </section>
        </div>

    </div>
</section>
@stop