@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to('admin/benefits', 'Beneficios'); ?> &raquo; Crear Nuevo
        </h3>
    </header>
    <?= Form::model($benefit, array('url' => 'admin/benefits/store', 'files' => true)); ?>
        <fieldset>
            <legend>Informaci&oacute;n B&aacute;sica</legend>
            <div class="name-field">
                <?php
                echo Form::label('nombre', 'Nombre');
                echo Form::text('nombre');
                ?>
                <?php if ($errors->has('nombre')): ?>
                    <small class="error"><?php echo $errors->first('nombre'); ?></small>
                <?php endif; ?>
            </div>

            <?php
            echo Form::label('descripcion', 'Descripción');
            echo Form::textarea('descripcion');
            ?>
            <?php if ($errors->has('descripcion')): ?>
                <small class="error"><?php echo $errors->first('descripcion'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('legal', 'Términos y Condiciones');
            echo Form::textarea('legal');
            ?>
            <?php if ($errors->has('legal')): ?>
                <small class="error"><?php echo $errors->first('legal'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('tags', 'Tags');
            echo Form::text('tags');
            ?>
            <?php if ($errors->has('tags')): ?>
                <small class="error"><?php echo $errors->first('tags'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('fecha', 'Fecha');
            echo Form::text('fecha');
            ?>
            <?php if ($errors->has('fecha')): ?>
                <small class="error"><?php echo $errors->first('fecha'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('sub_categoria_id', 'Sub Categoría');
            echo Form::select('sub_categoria_id', $categories);
            ?>
            <?php if ($errors->has('sub_categoria_id')): ?>
                <small class="error"><?php echo $errors->first('sub_categoria_id'); ?></small>
            <?php endif; ?>
        </fieldset>
        <fieldset>
            <legend>Ubicaciones</legend>
	        <fieldset>
		        <div class="entel-form-location">
			        <?php
			        echo Form::label('lat', 'Latitud');
			        echo Form::text('lat[]');
			        ?>
			        <?php if ($errors->has('lat')): ?>
				        <small class="error"><?php echo $errors->first('lat'); ?></small>
			        <?php endif; ?>

			        <?php
			        echo Form::label('lng', 'Longitud');
			        echo Form::text('lng[]');
			        ?>
			        <?php if ($errors->has('lng')): ?>
				        <small class="error"><?php echo $errors->first('lng'); ?></small>
			        <?php endif; ?>

			        <?php
			        echo Form::label('lugar', 'Lugar');
			        echo Form::text('lugar[]');
			        ?>
			        <?php if ($errors->has('lugar')): ?>
				        <small class="error"><?php echo $errors->first('lugar'); ?></small>
			        <?php endif; ?>
		        </div>
	        </fieldset>
	        <div class="locations"></div>
	        <a class="button tiny" id="add-location" href="#">{{ 'Agregar Ubicación' }}</a>
        </fieldset>
        <fieldset>
            <legend>SMS</legend>
            <?php
            echo Form::label('sms_texto', 'Texto');
            echo Form::text('sms_texto');
            ?>
            <?php if ($errors->has('sms_texto')): ?>
                <small class="error"><?php echo $errors->first('sms_texto'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('sms_nro', 'Número');
            echo Form::text('sms_nro');
            ?>
            <?php if ($errors->has('sms_nro')): ?>
                <small class="error"><?php echo $errors->first('sms_nro'); ?></small>
            <?php endif; ?>
        </fieldset>
        <fieldset>
            <legend>Im&aacute;genes</legend>
            <?php
            echo Form::label('imagen_grande', 'Grande');
            echo Form::file('imagen_grande');
            ?>
            <?php if ($errors->has('imagen_grande')): ?>
                <small class="error"><?php echo $errors->first('imagen_grande'); ?></small>
            <?php endif; ?>

	        <?php
	        echo Form::label('imagen_grande_web', 'Grande Web (800x135)');
	        echo Form::file('imagen_grande_web');
	        ?>
	        <?php if ($errors->has('imagen_grande_web')): ?>
		        <small class="error"><?php echo $errors->first('imagen_grande_web'); ?></small>
	        <?php endif; ?>

            <?php
            echo Form::label('imagen_chica', 'Chica');
            echo Form::file('imagen_chica');
            ?>
            <?php if ($errors->has('imagen_chica')): ?>
                <small class="error"><?php echo $errors->first('imagen_chica'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('icono', 'Ícono');
            echo Form::file('icono');
            ?>
            <?php if ($errors->has('icono')): ?>
                <small class="error"><?php echo $errors->first('icono'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('imagen_titulo', 'Título');
            echo Form::file('imagen_titulo');
            ?>
            <?php if ($errors->has('imagen_titulo')): ?>
                <small class="error"><?php echo $errors->first('imagen_titulo'); ?></small>
            <?php endif; ?>
        </fieldset>
        <?= Form::submit('Guardar', array('class' => 'button')); ?>
        <?= link_to('admin/benefits', 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop

@section('scripts')
<script type="text/template" id="entel-form-location-tpl">
	<fieldset>
		<div class="right" id="entel-location-control"><a class="remove-control" href="#"><i class="fa fa-times"></i></a></div>
		<div class="entel-form-location">
			<?php
			echo Form::label('lat', 'Latitud');
			echo Form::text('lat[]');
			?>
			<?php if ($errors->has('lat')): ?>
				<small class="error"><?php echo $errors->first('lat'); ?></small>
			<?php endif; ?>

			<?php
			echo Form::label('lng', 'Longitud');
			echo Form::text('lng[]');
			?>
			<?php if ($errors->has('lng')): ?>
				<small class="error"><?php echo $errors->first('lng'); ?></small>
			<?php endif; ?>

			<?php
			echo Form::label('lugar', 'Lugar');
			echo Form::text('lugar[]');
			?>
			<?php if ($errors->has('lugar')): ?>
				<small class="error"><?php echo $errors->first('lugar'); ?></small>
			<?php endif; ?>
		</div>
	</fieldset>
</script>
<script>
	(function($, _) {
		var tpl = _.template($('#entel-form-location-tpl').html());
		$('#add-location').on('click', function(e) {
			var $e = $(e.currentTarget);
			e.preventDefault();
			$('.locations').append($(tpl()).fadeIn(200));
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