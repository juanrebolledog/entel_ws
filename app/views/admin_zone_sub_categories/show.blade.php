@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías de Puntos Zona') }} &raquo; {{ link_to(action('AdminZoneCategoriesController@show', $category->id), $category->nombre) }} &raquo; {{ $sub_category->nombre }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminZoneSubCategoriesController@edit', array($category->id, $sub_category->id)), 'Editar') }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminZoneSubCategoriesController@create', $category->id), 'Crear Sub Categoría') }}
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>
	                {{ 'Información' }}
                </header>
                <div class="entel-item-content">
	                <dl>
		                <dt>{{ 'Nombre' }}</dt>
		                <dd>{{ $sub_category->nombre }}</dd>
		                <dt>{{ 'Categoría' }}</dt>
		                <dd>{{ link_to(action('AdminZoneCategoriesController@show', $category->id), $category->nombre) }}</dd>
		                <dt>{{ 'Ícono' }}</dt>
		                <dd>
			                <img src="{{ asset($sub_category->imagen_icono) }}" alt="{{ asset($sub_category->imagen_icono) }}"/>
			                <small>
				                <p>{{ asset($sub_category->imagen_icono) }}</p>
			                </small>
		                </dd>
	                </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop