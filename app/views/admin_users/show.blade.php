@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminUsersController@index'), 'Usuarios'); }} &raquo; {{ $user->nombres; }}
        </h3>
        <ul>
            <li>
                <a href="#map-element">Editar</a>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-8 medium-8 small-12 columns">
            <section class="entel-item entel-item-light">
                <header>{{ 'Detalles' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Nombres' }}</dt>
                        <dd>
                            {{ $user->nombres; }}
                        </dd>
                        <dt>{{ 'RUT' }}</dt>
                        <dd>
                            {{ $user->rut; }}
                        </dd>
                        <dt>{{ 'Teléfono Móvil' }}</dt>
                        <dd>
                            {{ $user->telefono_movil; }}
                        </dd>
                        <dt>{{ 'Correo' }}</dt>
                        <dd>
                            {{ $user->email; }}
                        </dd>
                        <dt>{{ 'Nivel' }}</dt>
                        <dd>
                            {{ $user->level->categoria }}
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
        <div class="large-4 medium-4 small-12 columns">
            <section class="entel-item">
                <header>&Uacute;ltimos Comentarios</header>
                <div class="entel-item-content">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->comments as $comment)
                        <tr>
                            <td>
                                {{ link_to(action('AdminBenefitsController@show', $comment->benefit->id), $comment->benefit->nombre) }}
                            </td>
                            <td>
                                {{ $comment->created_at }}
                            </td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </section>

            <section class="entel-item">
                <header>Valoraciones Recientes</header>
                <div class="entel-item-content">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->votes as $vote)
                        <tr>
                            <td>
                                {{ link_to(action('AdminBenefitsController@show', $vote->benefit->id), $vote->benefit->nombre) }}
                            </td>
                            <td>
                                {{ $vote->created_at }}
                            </td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </section>

            <section class="entel-item">
                <header>Beneficios Ignorados</header>
                <div class="entel-item-content">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->ignored_benefits as $ignored)
                        <tr>
                            <td>
                                {{ link_to(action('AdminBenefitsController@show', $ignored->benefit->id), $ignored->benefit->nombre) }}
                            </td>
                            <td>
                                {{ $ignored->created_at }}
                            </td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </section>

            <section class="entel-item">
                <header>Beneficios Cobrados</header>
                <div class="entel-item-content">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->benefits as $redeemed)
                        <tr>
                            <td>
                                {{ link_to(action('AdminBenefitsController@show', $redeemed->benefit->id), $redeemed->benefit->nombre) }}
                            </td>
                            <td>
                                {{ $redeemed->created_at }}
                            </td>
                            <td>
                                <a href="#"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </section>
        </div>
    </div>

</section>
@stop