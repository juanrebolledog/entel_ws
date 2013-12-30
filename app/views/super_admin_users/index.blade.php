@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Usuarios Admin
        </h3>
        <ul>
            <li>
                {{ link_to(action('SuperAdminUsersController@create'), 'Crear Nuevo') }}
            </li>
        </ul>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="element-search">
                <form action="#" method="post">
                    <input type="text" placeholder="Búsqueda"/>
                </form>
            </div>
            @if (!empty($users))
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th>{{ 'Correo' }}</th>
                    <th>{{ 'Último login' }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        {{ link_to(action('SuperAdminUsersController@show', $user['id']), $user['email']) }}
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        {{ HTML::decode(HTML::link(action('SuperAdminUsersController@show', $user['id']), '<span class="fa fa-eye"> Ver</span>')) }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p>
                {{ 'No hay usuarios administrativos registrados! ' . link_to(action('SuperAdminUsersController@create'), 'agrega uno aquí') }}.
            </p>
            @endif
        </div>
    </div>

</section>
@stop