@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Beneficios
        </h3>
        <ul>
            <li>
                <?= link_to('admin/benefits/create', 'Crear Nuevo'); ?>
            </li>
        </ul>
    </header>

    <div class="row">
        <div class="large-9 medium-9 small-12 columns">
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
                    <th width="200">Nombre</th>
                    <th width="400" class="hide-for-small">Descripci&oacute;n</th>
                    <th width="100">Sub Categor&iacute;a</th>
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
                        <?= link_to('/admin/benefits/sub_categories/' . $benefit->sub_category->id, $benefit->sub_category->nombre); ?>
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
        <div class="large-3 medium-3 small-12 columns">
            <section class="entel-item collapsable">
                <header>&Uacute;ltimos Comentarios <i class="fa fa-angle-down right"></i></header>
                <div class="entel-item-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Fecha</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="benefit.html">2x1 en la pizza mas peque...</a>
                            </td>
                            <td>
                                2013-11-23 14:07:43

                            </td>
                            <td>
                                <a href="comment.html"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="entel-item collapsable">
                <header>&Uacute;ltimas Valoraciones <i class="fa fa-angle-down right"></i></header>
                <div class="entel-item-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Beneficio</th>
                            <th>Val.</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="benefit.html">2x1 en la pizza mas peque...</a>
                            </td>
                            <td>5</td>
                            <td>
                                <a href="benefit.html"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="benefit.html">2x1 en la pizza mas peque...</a>
                            </td>
                            <td>4</td>
                            <td>
                                <a href="benefit.html"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="benefit.html">2x1 en la pizza mas peque...</a>
                            </td>
                            <td>5</td>
                            <td>
                                <a href="benefit.html"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
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