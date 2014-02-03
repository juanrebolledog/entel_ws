@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to('admin/summers', 'Veranos'); ?> &raquo; <?= link_to('admin/summers/' . $summer->id, $summer->nombre); ?> &raquo; Editar
        </h3>
    </header>
    <?= Form::model($summer, array('url' => 'admin/summers/' . $summer->id . '/update', 'method' => 'put', 'files' => true)); ?>
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
            echo Form::label('descripcion_larga', 'Descripción Larga');
            echo Form::textarea('descripcion_larga');
            ?>
            <?php if ($errors->has('descripcion_larga')): ?>
                <small class="error"><?php echo $errors->first('descripcion_larga'); ?></small>
            <?php endif; ?>

	        <?php
	        echo Form::label('texto_beneficio', 'Texto Beneficio');
	        echo Form::textarea('texto_beneficio');
	        ?>
	        <?php if ($errors->has('texto_beneficio')): ?>
		        <small class="error"><?php echo $errors->first('texto_beneficio'); ?></small>
	        <?php endif; ?>

            <?php
            echo Form::label('legal', 'Bases Legales');
            echo Form::text('legal');
            ?>
            <?php if ($errors->has('legal')): ?>
                <small class="error"><?php echo $errors->first('legal'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('fecha', 'Fecha');
            echo Form::input('date', 'fecha');
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
            <legend>Ubicaci&oacute;n</legend>
            <?php
            echo Form::label('lugar', 'Lugar');
            echo Form::text('lugar');
            ?>
            <?php if ($errors->has('lugar')): ?>
                <small class="error"><?php echo $errors->first('lugar'); ?></small>
            <?php endif; ?>

	        <?php
	        echo Form::label('horario', 'Horario');
	        echo Form::text('horario');
	        ?>
	        <?php if ($errors->has('horario')): ?>
		        <small class="error"><?php echo $errors->first('horario'); ?></small>
	        <?php endif; ?>
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
            echo Form::label('imagen_descripcion', 'Descripción');
            echo Form::file('imagen_descripcion');
            ?>
            <?php if ($errors->has('imagen_descripcion')): ?>
                <small class="error"><?php echo $errors->first('imagen_descripcion'); ?></small>
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
        <?= link_to('admin/summers', 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop