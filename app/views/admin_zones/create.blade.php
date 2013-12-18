@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminZonesController@index'), 'Zonas'); ?> &raquo; Crear Nueva
        </h3>
    </header>
    <?= Form::model($zone, array('url' => action('AdminZonesController@store'), 'files' => true)); ?>
        <fieldset>
            <legend>Informaci&oacute;n</legend>
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
            echo Form::label('url', 'URL');
            echo Form::text('url');
            ?>
            <?php if ($errors->has('url')): ?>
                <small class="error"><?php echo $errors->first('url'); ?></small>
            <?php endif; ?>

            <?php
            echo Form::label('imagen', 'Grande');
            echo Form::file('imagen');
            ?>
            <?php if ($errors->has('imagen')): ?>
                <small class="error"><?php echo $errors->first('imagen'); ?></small>
            <?php endif; ?>

        </fieldset>
        <?= Form::submit('Guardar', array('class' => 'button')); ?>
        <?= link_to(action('AdminZonesController@index'), 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop