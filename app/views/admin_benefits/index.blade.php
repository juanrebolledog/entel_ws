@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Beneficios
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminBenefitsController@create'), 'Crear Nuevo'); ?>
            </li>
        </ul>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="element-search">
                <form action="#" method="post">
                    <input type="text" placeholder="Búsqueda"/>
                </form>
            </div>
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th>Nombre</th>
                    <th class="hide-for-small">Descripci&oacute;n</th>
                    <th>Sub Categor&iacute;a</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($benefits as $benefit): ?>
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <?= link_to(action('AdminBenefitsController@show', $benefit->id), $benefit->nombre); ?>
                    </td>
                    <td class="hide-for-small">
                        <?= substr($benefit->descripcion, 0, 40); ?>
                    </td>
                    <td>
                        <?= link_to(action('AdminBenefitSubCategoriesController@show', $benefit->sub_category->id), $benefit->sub_category->nombre); ?>
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                        <?= HTML::decode(HTML::link(action('AdminBenefitsController@edit', $benefit->id), '<span class="fa fa-edit"></span>')); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop

@section('scripts')
<script>
    (function($) {
        $('.entel-item.collapsable').on('click', 'header', function(e) {
            e.preventDefault();
            var $e = $(e.currentTarget);
            $e.find('.fa').toggleClass('fa-angle-left').toggleClass('fa-angle-down');
            $e.parent('.entel-item').toggleClass('closed');
        });
    })(jQuery);
</script>
@stop