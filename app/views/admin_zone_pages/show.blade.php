@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminZonePagesController@index'), 'Páginas de Puntos Zona'); ?> &raquo; <?= $page->titulo; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminZonePagesController@edit', $page->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminZonePagesController@create'), 'Crear Nueva'); ?>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>{{ 'Información' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Título' }}</dt>
                        <dd>
                            {{ $page->titulo }}
                        </dd>
                        <dt>{{ 'Debes Saber' }}</dt>
                        <dd>
                            <ul>
	                            @if (!empty($page->obj_debes_saber))
	                                @foreach ($page->obj_debes_saber as $item)
	                                <li>{{ $item }}</li>
	                                @endforeach
	                            @endif
                            </ul>
                        </dd>
	                    <dt>{{ 'Contenido' }}</dt>
	                    <dd>
		                    @foreach ($page->obj_contenido as $item)
		                    <div class="item">
			                    @if (isset($item['titulo']))
			                    <h2>{{ $item['titulo'] }}</h2>
			                    @else
			                    <h2>{{ $item['categoria'] }}</h2>
			                    @endif
			                    @foreach ($keys as $key)
			                    @if (isset($item[$key]) && !is_array($item[$key]))
			                    <p>
				                    {{ ucfirst($key) }}: {{ $item[$key] }}
			                    </p>
			                    @elseif (isset($item[$key]) && is_array($item[$key]))
			                    <p>{{ ucfirst($key) }}:</p>
			                    <ul>
				                    @foreach ($keys as $sub_key)
				                    @if (isset($item[$key][0][$sub_key]))
				                    <li>
				                    {{ ucfirst($sub_key) }}: {{ $item[$key][0][$sub_key] }}
				                    </li>
				                    @endif

				                    @endforeach
			                    </ul>
			                    @endif
			                    @endforeach
		                    </div>
		                    @endforeach
	                    </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop