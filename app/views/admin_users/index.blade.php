@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Usuarios
        </h3>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="element-search">
                <form action="#" method="post">
                    <input type="text" placeholder="Búsqueda"/>
                </form>
            </div>
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th width="200">Nombre</th>
                    <th width="400" class="hide-for-small">Tel&eacute;fono M&oacute;vil</th>
                    <th width="100">RUT</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <?= $user['nombres']; ?> <?= $user['apellidos']; ?>
                    </td>
                    <td class="hide-for-small">
                        <?= $user['telefono_movil']; ?>
                    </td>
                    <td>
                        <?= $user['rut']; ?>
                    </td>
                    <td>
                        <?= HTML::decode(HTML::link('admin/users/' . $user['id'], '<span class="fa fa-eye"></span>')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop