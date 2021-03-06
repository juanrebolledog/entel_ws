@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Páginas de Puntos Zona' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminZonePagesController@create'), 'Crear Nueva') }}
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
                    <th>T&iacute;tulo</th>
                    <th width="100">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pages as $page): ?>
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <?= link_to(action('AdminZonePagesController@show', $page->id), $page->titulo); ?>
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link(action('AdminZonesController@show', $page->id), '<span class="fa fa-eye"></span>')); ?>
                        <?= HTML::decode(HTML::link(action('AdminZonesController@edit', $page->id), '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop