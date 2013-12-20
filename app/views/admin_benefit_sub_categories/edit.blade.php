@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminBenefitSubCategoriesController@index'), 'Sub Categorías de Beneficios'); ?> &raquo; <?= link_to(action('AdminBenefitSubCategoriesController@show', $category->id), $category->nombre); ?> &raquo; Editar
        </h3>
    </header>
    <?= Form::model($category, array('url' => action('AdminBenefitSubCategoriesController@update', $category->id), 'method' => 'put', 'files' => true)); ?>
        <fieldset>
            <legend>Informaci&oacute;n</legend>
            <?php
            echo Form::label('categoria_id', 'Categoría');
            echo Form::select('categoria_id', $categories);
            ?>
            <?php if ($errors->has('categoria_id')): ?>
                <small class="error"><?php echo $errors->first('categoria_id'); ?></small>
            <?php endif; ?>
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

        </fieldset>
        <?= Form::submit('Guardar', array('class' => 'button')); ?>
        <?= link_to(action('AdminBenefitCategoriesController@index'), 'Cancelar', array('class' => 'button secondary')); ?>
    <?= Form::close(); ?>
</section>
@stop