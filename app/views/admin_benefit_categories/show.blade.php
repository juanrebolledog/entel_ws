@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminBenefitCategoriesController@index'), 'Categorías de Beneficios'); ?> &raquo; <?= $category->nombre; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminBenefitCategoriesController@edit', $category->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminBenefitCategoriesController@create'), 'Crear Nueva'); ?>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>{{ 'Información' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Nombre' }}</dt>
                        <dd>
                            {{ $category->nombre }}
                        </dd>
                        <dt>{{ 'URL' }}</dt>
                        <dd>
                            {{ $category->banner_link }}
                        </dd>
                        <dt>{{ 'Banner' }}</dt>
                        <dd>
                            <img src="{{ asset($category->banner) }}" alt="{{ $category->banner }}"/>
                            <br/>
                            <small>
                                {{ $category->banner }}
                            </small>
                        </dd>
                        <dt>{{ 'Icono' }}</dt>
                        <dd>
                            <img src="{{ asset($category->icono) }}" alt="{{ $category->icono }}"/>
                            <br/>
                            <small>
                                {{ $category->icono }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop