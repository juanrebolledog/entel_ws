@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminEventCategoriesController@index'), 'Categoría de Eventos'); ?> &raquo; Editar
        </h3>
    </header>
    <?= Form::model($category, array('url' => action('AdminEventCategoriesController@update'), 'method' => 'put', 'files' => true)); ?>
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
        echo Form::label('banner_link', 'URL');
        echo Form::text('banner_link');
        ?>
        <?php if ($errors->has('banner_link')): ?>
            <small class="error"><?php echo $errors->first('banner_link'); ?></small>
        <?php endif; ?>

        <?php
        echo Form::label('banner', 'Banner');
        echo Form::file('banner');
        ?>
        <?php if ($errors->has('banner')): ?>
            <small class="error"><?php echo $errors->first('banner'); ?></small>
        <?php endif; ?>

        <?php
        echo Form::label('icono', 'Icono');
        echo Form::file('icono');
        ?>
        <?php if ($errors->has('icono')): ?>
            <small class="error"><?php echo $errors->first('icono'); ?></small>
        <?php endif; ?>

    </fieldset>
    <?= Form::submit('Guardar', array('class' => 'button')); ?>
    <?= link_to(action('AdminEventCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop