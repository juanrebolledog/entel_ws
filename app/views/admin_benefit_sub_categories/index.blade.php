@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Sub Categorías' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminBenefitSubCategoriesController@create'), 'Crear Nueva') }}
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
                    <th>Categoría Padre</th>
                    <th width="400">URL</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sub_categories as $sub_cat)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        {{ link_to(action('AdminBenefitSubCategoriesController@show', $sub_cat->id), $sub_cat->nombre); }}
                    </td>
                    <td>
                        {{ link_to(action('AdminBenefitCategoriesController@show', $sub_cat->category->id), $sub_cat->category->nombre) }}
                    </td>
                    <td>
                        {{ $sub_cat->banner_link }}
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link(action('AdminBenefitSubCategoriesController@show', $sub_cat->id), '<span class="fa fa-eye"></span>')); ?>
                        <?= HTML::decode(HTML::link(action('AdminBenefitSubCategoriesController@edit', $sub_cat->id), '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop