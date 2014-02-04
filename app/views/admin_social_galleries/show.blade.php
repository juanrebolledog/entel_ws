@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSocialGalleriesController@index'), 'Galerías Sociales') }} &raquo; {{ $social_gallery->nombre }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminSocialGalleriesController@edit', $social_gallery->id), 'Editar') }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminSocialGalleriesController@create'), 'Crear Nueva') }}
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
                            {{ $social_gallery->nombre }}
                        </dd>
                        <dt>{{ 'Fecha' }}</dt>
                        <dd>
                            {{ $social_gallery->fecha }}
                        </dd>
                        <dt>{{ 'Imágen' }}</dt>
                        <dd>
                            <img src="{{ asset($social_gallery->imagen_web) }}" alt="{{ asset($social_gallery->imagen_web) }}"/>
                            <br/>
                            <small>
                                {{ asset($social_gallery->imagen_web) }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>

	        <section class="entel-item">
		        <header>{{ 'Imágenes' }}</header>
		        <div class="entel-item-content">
			        <table class="entel-table">
				        <thead>
				        <tr>
					        <th>{{ 'Texto' }}</th>
					        <th>{{ 'Ruta' }}</th>
				        </tr>
				        </thead>
				        <tbody>
				        @foreach ($social_gallery->images as $image)
				        <tr>
					        <td>{{ $image->descripcion }}</td>
					        <td>{{ asset($image->imagen) }}</td>
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