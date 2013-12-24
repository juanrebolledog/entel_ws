@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminEventCategoriesController@index'), 'Categoría de Eventos: ' . $category->nombre) }} &raquo;
            {{ $sub_category->nombre }}
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminEventCategoriesController@edit_sub', $sub_category->id), 'Editar'); ?>
            </li>
            <li>
                <?= link_to(action('AdminEventCategoriesController@create_sub'), 'Crear Nueva'); ?>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item entel-item-light">
                <header>{{ 'Información' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Nombre' }}</dt>
                        <dd>
                            {{ $sub_category->nombre }}
                        </dd>
                        <dt>{{ 'URL' }}</dt>
                        <dd>
                            {{ $sub_category->banner_link }}
                        </dd>
                        <dt>{{ 'Banner' }}</dt>
                        <dd>
                            <img src="{{ asset($sub_category->banner) }}" alt="{{ $sub_category->banner }}"/>
                            <br/>
                            <small>
                                {{ $sub_category->banner }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop