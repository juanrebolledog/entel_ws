@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminUsersController@index'), 'Usuarios'); ?> &raquo; <?= $user->nombres; ?>
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
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>Detalles</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>Nombres</dt>
                        <dd>
                            <?= $user->nombres; ?>
                        </dd>
                        <dt>RUT</dt>
                        <dd>
                            <?= $user->rut; ?>
                        </dd>
                        <dt>Tel&eacute;fono M&oacute;vil</dt>
                        <dd>
                            <?= $user->telefono_movil; ?>
                        </dd>
                        <dt>Correo</dt>
                        <dd>
                            <?= $user->email; ?>
                        </dd>
                    </dl>
                </div>
            </section>
            <section class="entel-item">
                <header>&Uacute;ltimos Comentarios</header>
                <div class="entel-item-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

</section>
@stop