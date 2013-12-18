@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Comentarios
        </h3>
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
                    <th width="200">Usuario</th>
                    <th width="400" class="hide-for-small">Mensaje</th>
                    <th width="100">Beneficio</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <?= link_to(action('AdminUsersController@show', $comment->usuario_id), $comment->user->nombres); ?>
                    </td>
                    <td class="hide-for-small">
                        <?= link_to(action('AdminBenefitCommentsController@show', $comment->id), substr($comment->mensaje, 0, 40)); ?>
                    </td>
                    <td>
                        <?= link_to(action('AdminBenefitsController@show', $comment->beneficio_id), $comment->benefit->nombre); ?>
                    </td>
                    <td>
                        <a href="#" alt="Desactivar"><span class="fa fa-eye-slash"></span></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop