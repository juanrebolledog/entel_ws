@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to('admin/events', 'Eventos'); ?> &raquo; Crear Nuevo
        </h3>
    </header>
    <?= Form::model($event, array('url' => 'admin/events/store', 'files' => true)); ?>
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
            echo Form::label('post', 'Post');
            echo Form::textarea('post');
            ?>
            <?php if ($errors->has('post')): ?>
                <small class="error"><?php echo $errors->first('post'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('tags', 'Tags');
            echo Form::text('tags');
            ?>
            <?php if ($errors->has('tags')): ?>
                <small class="error"><?php echo $errors->first('tags'); ?></small>
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
            <legend>Valores y Descuentos</legend>
            <div class="row">
                <div class="column large-10">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>{{ 'Localidad' }}</th>
                            <th>{{ 'Valor' }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{ Form::text('localidad[]') }}
                            </td>
                            <td>
                                {{ Form::text('valor[]') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#">Agregar otra localidad</a>
                </div>
                <div class="column large-2">
                    <table class="entel-table">
                        <thead>
                        <tr>
                            <th>{{ 'Descuentos' }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{ Form::text('descuento[]') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#">Agregar otro descuento</a>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Ubicaci&oacute;n</legend>
            <?php
            echo Form::label('lat', 'Latitud');
            echo Form::text('lat');
            ?>
            <?php if ($errors->has('lat')): ?>
                <small class="error"><?php echo $errors->first('lat'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('lng', 'Longitud');
            echo Form::text('lng');
            ?>
            <?php if ($errors->has('lng')): ?>
                <small class="error"><?php echo $errors->first('lng'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('lugar', 'Lugar');
            echo Form::text('lugar');
            ?>
            <?php if ($errors->has('lugar')): ?>
                <small class="error"><?php echo $errors->first('lugar'); ?></small>
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
            echo Form::label('imagen_grande', 'Grande');
            echo Form::file('imagen_grande');
            ?>
            <?php if ($errors->has('imagen_grande')): ?>
                <small class="error"><?php echo $errors->first('imagen_grande'); ?></small>
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

            <?php
            echo Form::label('imagen_grande_web', 'Grande Web');
            echo Form::file('imagen_grande_web');
            ?>
            <?php if ($errors->has('imagen_grande_web')): ?>
                <small class="error"><?php echo $errors->first('imagen_grande_web'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('imagen_ubicacion', 'Ubicación');
            echo Form::file('imagen_ubicacion');
            ?>
            <?php if ($errors->has('imagen_ubicacion')): ?>
                <small class="error"><?php echo $errors->first('imagen_ubicacion'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('imagen_bg', 'Fondo');
            echo Form::file('imagen_bg');
            ?>
            <?php if ($errors->has('imagen_bg')): ?>
                <small class="error"><?php echo $errors->first('imagen_bg'); ?></small>
            <?php endif; ?>
        </fieldset>
        <?= Form::submit('Guardar', array('class' => 'button')); ?>
        <?= link_to('admin/events', 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop