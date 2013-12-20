@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminBenefitCategoriesController@index'), 'Categorías de Beneficios'); }} &raquo;
            {{ link_to(action('AdminBenefitSubCategoriesController@index'), 'Sub Categorías') }} &raquo;
            {{ $sub_category->nombre; }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminBenefitSubCategoriesController@edit', $sub_category->id), 'Editar'); }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminBenefitSubCategoriesController@create'), 'Crear Nueva'); }}
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>{{ 'Información' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Categoría Padre' }}</dt>
                        <dd>
                            {{ link_to(action('AdminBenefitCategoriesController@show', $sub_category->category->id), $sub_category->category->nombre) }}
                        </dd>
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
                                {{ asset($sub_category->banner) }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop