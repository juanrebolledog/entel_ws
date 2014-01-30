@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías de Puntos Zona') }} &raquo; {{ $category->nombre }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminZoneCategoriesController@edit', $category->id), 'Editar') }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminZoneCategoriesController@create'), 'Crear Nueva Categoría') }}
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section>
                <header>
	                <h4>{{ 'Sub Categorías' }}</h4>
	                <ul>
		                <li>{{ link_to(action('AdminZoneSubCategoriesController@create', $category->id), 'Agregar Sub Categoría') }}</li>
	                </ul>
                </header>
                <div class="content">
	                <table class="entel-table">
		                <thead>
		                <tr>
			                <th>{{ 'Nombre' }}</th>
			                <th>{{ 'Puntos Zona' }}</th>
			                <th>&nbsp;</th>
		                </tr>
		                </thead>
		                <tbody>
		                @foreach ($category->sub_categories as $scategory)
		                <tr>
			                <td>{{ $scategory->nombre }}</td>
			                <td>{{ count($scategory->zones) }}</td>
			                <td>
				                {{ link_to(action('AdminZoneSubCategoriesController@show', array($category->id, $scategory->id)), 'Ver') }}
				                {{ link_to(action('AdminZoneSubCategoriesController@edit', array($category->id, $scategory->id)), 'Editar') }}
			                </td>
		                </tr>
		                @endforeach
		                </tbody>
	                </table>
                </div>
            </section>
        </div>
    </div>

</section>
@stop