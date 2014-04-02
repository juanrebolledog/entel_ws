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
            echo Form::textarea('legal');
            ?>
            <?php if ($errors->has('legal')): ?>
                <small class="error"><?php echo $errors->first('legal'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('sub_categoria_id', 'Sub Categoría');
            echo Form::select('sub_categoria_id', $categories);
            ?>
            <?php if ($errors->has('sub_categoria_id')): ?>
                <small class="error"><?php echo $errors->first('sub_categoria_id'); ?></small>
            <?php endif; ?>
        </fieldset>
        <!--
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
                                {{ Form::text('localidad[0]') }}
                            </td>
                            <td>
                                {{ Form::text('valor[0]') }}
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
                                {{ Form::text('descuento[0]') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#">Agregar otro descuento</a>
                </div>
            </div>
        </fieldset>
        -->
        <fieldset>
            <legend>Ubicaciones</legend>
            <fieldset>
                <div class="entel-form-location">
                    <?php
                    echo Form::label('location[lat]', 'Latitud');
                    echo Form::text('location[0][lat]');
                    ?>
                    <?php if ($errors->has('location[lat]')): ?>
                        <small class="error"><?php echo $errors->first('location[lat]'); ?></small>
                    <?php endif; ?>

                    <?php
                    echo Form::label('location[lng]', 'Longitud');
                    echo Form::text('location[0][lng]');
                    ?>
                    <?php if ($errors->has('location[lng]')): ?>
                        <small class="error"><?php echo $errors->first('location[lng]'); ?></small>
                    <?php endif; ?>

                    <?php
                    echo Form::label('location[lugar]', 'Lugar');
                    echo Form::text('location[0][lugar]');
                    ?>
                    <?php if ($errors->has('location[lugar]')): ?>
                        <small class="error"><?php echo $errors->first('location[lugar]'); ?></small>
                    <?php endif; ?>

                    <?php
                    echo Form::label('location[fecha]', 'Fecha');
                    echo Form::input('date', 'location[0][fecha]');
                    ?>
                    <?php if ($errors->has('location[fecha]')): ?>
                        <small class="error"><?php echo $errors->first('location[fecha]'); ?></small>
                    <?php endif; ?>

                    <?php
                    echo Form::label('location[hora]', 'Horario');
                    echo Form::text('location[0][hora]');
                    ?>
                    <?php if ($errors->has('location[hora]')): ?>
                        <small class="error"><?php echo $errors->first('location[hora]'); ?></small>
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

@section('scripts')
<script type="text/template" id="entel-form-location-tpl">
    <fieldset>
        <div class="right" id="entel-location-control"><a class="remove-control" href="#"><i class="fa fa-times"></i></a></div>
        <div class="entel-form-location">
            <?php
            echo Form::label('location[lat]', 'Latitud');
            ?>
            <input name="location[<%= elem %>][lat]" type="text">
            <?php if ($errors->has('location[lat]')): ?>
                <small class="error"><?php echo $errors->first('location[lat]'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('location[lng]', 'Longitud');
            ?>
            <input name="location[<%= elem %>][lng]" type="text">
            <?php if ($errors->has('location[lng]')): ?>
                <small class="error"><?php echo $errors->first('location[lng]'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('location[lugar]', 'Lugar');
            ?>
            <input name="location[<%= elem %>][lugar]" type="text">
            <?php if ($errors->has('location[lugar]')): ?>
                <small class="error"><?php echo $errors->first('location[lugar]'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('location[fecha]', 'Fecha');
            ?>
            <input name="location[<%= elem %>][fecha]" type="date">
            <?php if ($errors->has('location[fecha]')): ?>
                <small class="error"><?php echo $errors->first('location[fecha]'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('location[hora]', 'Horario');
            ?>
            <input name="location[<%= elem %>][hora]" type="text">
            <?php if ($errors->has('location[hora]')): ?>
                <small class="error"><?php echo $errors->first('location[hora]'); ?></small>
            <?php endif; ?>
        </div>
    </fieldset>
</script>
<script>
    (function($, _) {
        var template = $('#entel-form-location-tpl').text();
        $('#add-location').on('click', function(e) {
            var $locations = $('.locations');
            var $e = $(e.currentTarget);
            e.preventDefault();
            var k = $locations.children().length;
            var tpl = _.template(template);
            $locations.append(tpl({ elem: k+1 }));
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