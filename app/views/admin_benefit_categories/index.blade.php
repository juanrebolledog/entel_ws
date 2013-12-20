@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Categorías de Beneficios' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminBenefitCategoriesController@create'), 'Crear Nueva') }}
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
            @foreach ($categories as $category)
            <h3>{{ link_to(action('AdminBenefitCategoriesController@show', $category->id), $category->nombre) }}</h3>
            @if (count($category->sub_categories) > 0)
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th width="200">Nombre</th>
                    <th width="400">URL</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($category->sub_categories as $sub_cat)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        {{ link_to(action('AdminBenefitCategoriesController@show', $sub_cat->id), $sub_cat->nombre); }}
                    </td>
                    <td>
                        {{ $sub_cat->banner_link }}
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link(action('AdminBenefitCategoriesController@show', $sub_cat->id), '<span class="fa fa-eye"></span>')); ?>
                        <?= HTML::decode(HTML::link(action('AdminBenefitCategoriesController@edit', $sub_cat->id), '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p>{{ 'Categoría vacía' }}, {{ link_to(action('AdminBenefitCategoriesController@create'), 'agrega una') }}.</p>
            @endif
            @endforeach
        </div>
    </div>

</section>
@stop