@extends('admin_layout')

@section('content')
<section>
	<header>
		<h3>
			{{ link_to(action('AdminContestsController@index'), 'Concursos') }} &raquo; {{ link_to(action('AdminContestsController@show', $contest->id), $contest->nombre) }} &raquo; Editar
		</h3>
	</header>
	{{ Form::model($contest, array('url' => action('AdminContestsController@update', $contest->id), 'files' => true, 'method' => 'put')) }}
	<fieldset>
		<legend>{{ 'Información' }}</legend>
		<div class="name-field">
			{{ Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre') }}
			@if ($errors->has('nombre'))
			<small class="error">{{ $errors->first('nombre') }}</small>
			@endif
		</div>

		{{ Form::label('descripcion', 'Descripción') }}
		{{ Form::textarea('descripcion') }}
		@if ($errors->has('descripcion'))
		<small class="error">{{ $errors->first('descripcion') }}</small>
		@endif

		{{ Form::label('imagen_banner', 'Banner') }}
		{{ Form::file('imagen_banner') }}
		@if ($errors->has('imagen_banner'))
		<small class="error">{{ $errors->first('imagen_banner') }}</small>
		@endif

	</fieldset>

	<fieldset>
		<legend>{{ 'Ganadores' }}</legend>
		<table class="entel-table">
			<thead>
			<tr>
				<th>{{ 'Nombres' }}</th>
				<th>{{ 'RUT' }}</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($contest->winners as $winner)
			<tr>
				{{ Form::hidden('ganadores[id][]', $winner->id) }}
				<td>
					{{ Form::text('ganadores[nombres][]', $winner->nombres) }}
				</td>
				<td>
					{{ Form::text('ganadores[rut][]' . $winner->id, $winner->rut) }}
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		<a id="add-winner" class="button tiny" href="#">Agregar otro Ganador</a>
	</fieldset>
	{{ Form::submit('Guardar', array('class' => 'button')) }}
	{{ link_to(action('AdminContestsController@index'), 'Cancelar', array('class' => 'button secondary')) }}
	{{ Form::close() }}
</section>
@stop

@section('scripts')
<script type="text/template" id="entel-form-location-tpl">
	<tr>
		<td>
			{{ Form::text('ganadores_n[nombres][]') }}
		</td>
		<td>
			{{ Form::text('ganadores_n[rut][]') }}
		</td>
	</tr>
</script>
<script>
	(function($, _) {
		var tpl = _.template($('#entel-form-location-tpl').html());
		$('#add-winner').on('click', function(e) {
			var $e = $(e.currentTarget);
			e.preventDefault();
			$('.entel-table').find('tbody').append($(tpl()).fadeIn(200));
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