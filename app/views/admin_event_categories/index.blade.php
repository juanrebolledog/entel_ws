@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Categorías de Eventos' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminEventCategoriesController@edit'), 'Editar Categoría') }}
            </li>
            <li>
                {{ link_to(action('AdminEventCategoriesController@create_sub'), 'Crear Nueva Sub Categoría') }}
            </li>

        </ul>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <h4>{{ 'Categoría Principal' }}</h4>
            <section class="entel-item entel-item-light">
                <header>{{ $category->nombre }}</header>
                <article class="entel-item-content">
                    <dl>
                        <dt>{{ 'Banner' }}</dt>
                        <dd>
                            <img src="{{ asset($category->banner) }}" alt="{{ asset($category->banner) }}"/>
                        </dd>
                        <dt>{{ 'Banner Link' }}</dt>
                        <dd>{{ $category->banner_link }}</dd>
                        <dt>{{ 'Icono' }}</dt>
                        <dd>
                            <img src="{{ asset($category->icono) }}" alt="{{ asset($category->icono) }}"/>
                        </dd>
                    </dl>
                </article>
            </section>
            <h4>{{ 'Sub Categorías' }}</h4>
            <section class="entel-item entel-item-light">
                <header></header>
                <article class="entel-item-content">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>{{ 'Nombre' }}</th>
                            <th>{{ 'Banner URL' }}</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($category->sub_categories as $sub_cat)
                        <tr>
                            <td>
                                {{ $sub_cat->nombre }}
                            </td>
                            <td>
                                {{ $sub_cat->banner_link }}
                            </td>
                            <td>
                                {{ link_to(action('AdminEventCategoriesController@show_sub', $sub_cat->id), 'Ver') }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </article>
            </section>

        </div>
    </div>

</section>
@stop