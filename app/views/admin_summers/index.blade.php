@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Veranos' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminSummersController@create'), 'Crear Nuevo') }}
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
                    <th>Nombre</th>
                    <th>Categor&iacute;a</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($summers as $summer)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        {{ link_to(action('AdminSummersController@show', $summer->id), $summer->nombre) }}
                    </td>
                    <td class="hide-for-small">
                        <?= substr($summer->descripcion, 0, 40); ?>
                    </td>
                    <td>
                        <?= link_to('admin/categories/1', $summer->category->nombre); ?>
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link('admin/summers/' . $summer->id . '/edit', '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop