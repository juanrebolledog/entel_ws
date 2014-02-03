@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSummerCategoriesController@index'), 'Categorías de Veranos') }} &raquo; {{ $category->nombre }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminSummerCategoriesController@edit', $category->id), 'Editar') }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminSummerCategoriesController@create'), 'Crear Nueva Categoría') }}
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section>
                <header>
	                <h4>{{ 'Veranos' }}</h4>
	                <ul>
		                <li>{{ link_to(action('AdminSummersController@create'), 'Agregar "Verano"') }}</li>
	                </ul>
                </header>
                <div class="content">
	                <table class="entel-table">
		                <thead>
		                <tr>
			                <th>{{ 'Nombre' }}</th>
			                <th>&nbsp;</th>
		                </tr>
		                </thead>
		                <tbody>
		                @foreach ($category->summers as $summer)
		                <tr>
			                <td>{{ $scategory->nombre }}</td>
			                <td>
				                {{ link_to(action('AdminSummersController@show', $summer->id), 'Ver') }}
				                {{ link_to(action('AdminSummersController@edit', $summer->id), 'Editar') }}
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