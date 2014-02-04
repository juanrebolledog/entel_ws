@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminContestsController@index'), 'Zonas'); ?> &raquo; <?= $contest->nombre; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminContestsController@edit', $contest->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminContestsController@create'), 'Crear Nueva'); ?>
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
                            {{ $contest->nombre }}
                        </dd>
                        <dt>{{ 'Descripción' }}</dt>
                        <dd>
                            {{ $contest->descripcion }}
                        </dd>
                        <dt>{{ 'Imágen' }}</dt>
                        <dd>
                            <img src="{{ asset($contest->imagen_banner) }}" alt="{{ asset($contest->imagen_banner) }}"/>
                            <br/>
                            <small>
                                {{ asset($contest->imagen_banner) }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>

	        <section class="entel-item">
		        <header>{{ 'Ganadores' }}</header>
		        <div class="entel-item-content">
			        <table class="entel-table">
				        <thead>
				        <tr>
					        <th>{{ 'Nombre' }}</th>
					        <th>{{ 'RUT' }}</th>
				        </tr>
				        </thead>
				        <tbody>
				        @foreach ($contest->winners as $winner)
				        <tr>
					        <td>{{ $winner->nombres }}</td>
					        <td>{{ $winner->rut }}</td>
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