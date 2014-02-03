@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSummersController@index'), 'Veranos') }} &raquo; {{ $summer->nombre }}
        </h3>
        <ul>
            <li>
                {{ link_to(action('AdminSummersController@edit', $summer->id), 'Editar') }}
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                {{ link_to(action('AdminSummersController@create'), 'Crear Nuevo') }}
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-5 medium-6 small-12 columns">
            <section class="entel-item">
                <header>Descripci&oacute;n</header>
                <div class="entel-item-content">
                    {{ $summer->descripcion }}
                </div>
            </section>
            <section class="entel-item">
                <header>Descripci&oacute;n Larga</header>
                <div class="entel-item-content">
                    {{ $summer->descripcion_larga }}
                </div>
            </section>
	        <section class="entel-item">
		        <header>Texto Beneficio</header>
		        <div class="entel-item-content">
			        {{ $summer->texto_beneficio }}
		        </div>
	        </section>
            <section class="entel-item">
                <header>Fecha</header>
                <div class="entel-item-content">
                    {{ $summer->fecha }}
                </div>
            </section>
            <section class="entel-item">
                <header>Lugar</header>
                <div class="entel-item-content">
                    {{ $summer->lugar }}
                </div>
            </section>
	        <section class="entel-item">
		        <header>Horario</header>
		        <div class="entel-item-content">
			        {{ $summer->horario }}
		        </div>
	        </section>
            <section class="entel-item">
                <header>Categor&iacute;a</header>
                <div class="entel-item-content">
	                {{ link_to(action('AdminSummerCategoriesController@show', $summer->category->id), $summer->category->nombre) }}
                </div>
            </section>
            <section class="entel-item">
                <header>SMS</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>Nro</dt>
                        <dd>{{ $summer->sms_nro }}</dd>
                        <dt>Texto</dt>
                        <dd>{{ $summer->sms_texto }}</dd>
                    </dl>
                </div>
            </section>
        </div>
        <div class="large-7 medium-6 small-12 columns">
            <section class="entel-item">
                <header>Im&aacute;genes</header>
                <div class="entel-item-content">
                    <div class="entel-image">
                        <img src="{{ asset($summer->imagen_descripcion) }}" alt="">
                        <header>
                            Descripci&oacute;n / 500x100 / {{ asset($summer->imagen_descripcion) }}
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="{{ asset($summer->imagen_titulo) }}" alt="">
                        <header>
                            T&iacute;tulo / 800x50 / {{ asset($summer->imagen_titulo) }}
                        </header>
                    </div>
                </div>
            </section>
        </div>
    </div>

</section>
@stop