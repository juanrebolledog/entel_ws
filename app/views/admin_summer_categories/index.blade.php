@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Categorías de Veranos' }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminSummerCategoriesController@create'), 'Crear Nueva') }}
            </li>
        </ul>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
	        @foreach ($categories as $category)
	        <section>
		        <header>
			        <h4>{{ link_to(action('AdminSummerCategoriesController@show', $category->id), $category->nombre) }}</h4>
			        <ul>
				        <li>{{ link_to(action('AdminSummerCategoriesController@edit', $category->id), 'Editar') }}</li>
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
					        <th width="100">&nbsp;</th>
				        </tr>
				        </thead>
				        <tbody>
				        @foreach ($category->summers as $summer)
				        <tr>
					        <td>
						        <input type="checkbox">
					        </td>
					        <td>
						        {{ link_to(action('AdminSummersController@show', $summer->id), $summer->nombre) }}
					        </td>
					        <td>
						        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
						        <?= HTML::decode(HTML::link(action('AdminSummerCategoriesController@show', $category->id), '<span class="fa fa-eye"></span>')); ?>
						        <?= HTML::decode(HTML::link(action('AdminSummerCategoriesController@edit', $category->id), '<span class="fa fa-edit"></span>')); ?>
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