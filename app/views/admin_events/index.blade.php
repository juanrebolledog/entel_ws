@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Eventos
        </h3>
        <ul>
            <li>
                <?= link_to('admin/events/create', 'Crear Nuevo'); ?>
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
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th width="200">Nombre</th>
                    <th width="400" class="hide-for-small">Descripci&oacute;n</th>
                    <th width="100">Sub Categor&iacute;a</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <?= link_to('admin/events/' . $event->id, $event->nombre); ?>
                    </td>
                    <td class="hide-for-small">
                        <?= substr($event->descripcion, 0, 40); ?>
                    </td>
                    <td>
                        <?= link_to('admin/categories/1', 'Comida Rápida'); ?>
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link('admin/events/' . $event->id . '/edit', '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop