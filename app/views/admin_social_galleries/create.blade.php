@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminSocialGalleriesController@index'), 'Concursos') }} &raquo; Crear Nuevo
        </h3>
    </header>
    {{ Form::model($social_gallery, array('url' => action('AdminSocialGalleriesController@store'), 'files' => true)) }}
        <fieldset>
            <legend>{{ 'Información' }}</legend>
            <div class="name-field">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre') }}
                @if ($errors->has('nombre'))
                    <small class="error">{{ $errors->first('nombre') }}</small>
                @endif
            </div>

			{{ Form::label('fecha', 'Fecha') }}
			{{ Form::input('date', 'fecha') }}
			@if ($errors->has('fecha'))
				<small class="error">{{ $errors->first('fecha') }}</small>
			@endif

            {{ Form::label('imagen_web', 'Imágen') }}
            {{ Form::file('imagen_web') }}
            @if ($errors->has('imagen_web'))
                <small class="error">{{ $errors->first('imagen_web') }}</small>
            @endif

        </fieldset>

		<fieldset>
			<legend>{{ 'Imágenes' }}</legend>
			<div class="images row">

			</div>
			{{ Form::file('imagenes[]', array('multiple' => true)) }}
		</fieldset>
        {{ Form::submit('Guardar', array('class' => 'button')) }}
        {{ link_to(action('AdminSocialGalleriesController@index'), 'Cancelar', array('class' => 'button secondary')) }}
    {{ Form::close() }}
</section>
@stop

@section('scripts')
<script type="text/template" id="gallery-image-tpl">
	<div class="image columns large-3">
		<img src="<%= imagen %>" alt="<%= imagen %>"/>
		{{ Form::text('descripcion[]') }}
	</div>
</script>
<script>
	(function($, _) {
		var tpl = _.template($('#gallery-image-tpl').html());
		$('input[name="imagenes[]"]').on('change', function(e) {
			var $e = $(e.currentTarget);

			_.each($e[0].files, function(file) {
				var reader  = new FileReader();
				var image_name = '';

				reader.onloadend = function () {
					$('.images').append($(tpl({ imagen: reader.result })).fadeIn(200));
				};

				if (file) {
					reader.readAsDataURL(file);
				} else {
					image_name = 'http://lorempixel.com/200/200';
					$('.images').append($(tpl({ imagen: image_name })).fadeIn(200));
				}
			});
		});
		$('.locations').on('click', '.remove-control', function(e) {
			e.preventDefault();
			var $e = $(e.currentTarget);
			$e.parent().parent('fieldset').fadeOut(200, function() {
				this.remove();
			});
		});
	})(jQuery, _);
</script>
@stop