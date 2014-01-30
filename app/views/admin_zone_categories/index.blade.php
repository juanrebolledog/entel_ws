@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Categorías de Puntos Zona' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminZoneCategoriesController@create'), 'Crear Nueva') }}
            </li>
        </ul>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
	        @foreach ($categories as $category)
	        <section>
		        <header>
			        <h4>{{ link_to(action('AdminZoneCategoriesController@show', $category->id), $category->nombre) }}</h4>
			        <ul>
				        <li>{{ link_to(action('AdminZoneCategoriesController@edit', $category->id), 'Editar') }}</li>
			        </ul>
		        </header>
		        <div class="content">
			        <table class="entel-table">
				        <thead>
				        <tr>
					        <th width="50">
						        <input type="checkbox">
					        </th>
					        <th>Nombre</th>
					        <th>Puntos</th>
					        <th width="100">&nbsp;</th>
				        </tr>
				        </thead>
				        <tbody>
				        @foreach ($category->sub_categories as $scategory)
				        <tr>
					        <td>
						        <input type="checkbox">
					        </td>
					        <td>
						        {{ link_to(action('AdminZoneCategoriesController@show', $category->id), $scategory->nombre) }}
					        </td>
					        <td>
						        {{ count($scategory->zones) }}
					        </td>
					        <td>
						        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
						        <?= HTML::decode(HTML::link(action('AdminZoneCategoriesController@show', $category->id), '<span class="fa fa-eye"></span>')); ?>
						        <?= HTML::decode(HTML::link(action('AdminZoneCategoriesController@edit', $category->id), '<span class="fa fa-edit"></span>')); ?>
					        </td>
				        </tr>
				        @endforeach
				        </tbody>
			        </table>
		        </div>
	        </section>
	        @endforeach
        </div>
    </div>

</section>
@stop