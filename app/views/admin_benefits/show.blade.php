@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminBenefitsController@index'), 'Beneficios'); ?> &raquo; <?= $benefit->nombre; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminBenefitsController@edit', $benefit->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminBenefitsController@create'), 'Crear Nuevo'); ?>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-6 medium-6 small-12 columns">
            <section class="entel-item">
                <header>Ubicaci&oacute;n</header>
                <div id='map-element'></div>
                <div class="entel-item-content">
                    <small>
                        <strong>Lat.:</strong> <?= $benefit->lat; ?> <strong>Lng.:</strong> <?= $benefit->lng; ?>
                    </small>
                </div>
            </section>
            <section class="entel-item">
                <header>Descripci&oacute;n</header>
                <div class="entel-item-content">
                    <?= $benefit->descripcion; ?>
                </div>
            </section>
            <section class="entel-item">
                <header>Sub Categor&iacute;a</header>
                <div class="entel-item-content">
                    {{ link_to(action('AdminBenefitSubCategoriesController@show', $benefit->sub_category->id), $benefit->sub_category->nombre) }}
                </div>
            </section>
            <section class="entel-item">
                <header>T&eacute;rminos y Condiciones</header>
                <div class="entel-item-content">
                    <?= $benefit->legal; ?>
                </div>
            </section>
            <section class="entel-item">
                <header>SMS</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>Nro</dt>
                        <dd><?= $benefit->sms_nro; ?></dd>
                        <dt>Texto</dt>
                        <dd><?= $benefit->sms_texto; ?></dd>
                    </dl>
                </div>
            </section>
            <section class="entel-item">
                <header>Tags</header>
                <div class="entel-item-content">
                    <?php foreach (explode(',', $benefit->tags) as $tag): ?>
                    <span class="round label"><?= trim($tag); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            <section class="entel-item">
                <header>Mas Info.</header>
                <div class="entel-item-content">
                    <small>[vac&iacute;o]</small>
                </div>
            </section>
        </div>
        <div class="large-6 medium-6 small-12 columns">
            <section class="entel-item breakable">
                <header>Im&aacute;genes</header>
                <div class="entel-item-content">
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_grande); ?>" alt="">
                        <header>
                            Grande / 800x200 <br/> <?= asset($benefit->imagen_grande); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_chica); ?>" alt="">
                        <header>
                            Chica / 500x100 <br/> <?= asset($benefit->imagen_chica); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->icono); ?>" alt="">
                        <header>
                            Icono / 256x256 <br/> <?= asset($benefit->icono); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_titulo); ?>" alt="">
                        <header>
                            T&iacute;tulo / 800x50 <br/> <?= asset($benefit->imagen_titulo); ?>
                        </header>
                    </div>
                </div>
            </section>
            <section class="entel-item">
                <header>Comentarios</header>
                <div class="entel-item-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Mensaje</th>
                            <th>Fecha &#x21e3</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($benefit->comments as $comment)
                        <tr>
                            <td>{{ link_to(action('AdminUsersController@show', $comment->usuario_id), $comment->user->nombres) }}</td>
                            <td>{{ $comment->mensaje }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                {{ link_to(action('AdminBenefitCommentsController@show', $comment->id), 'Ver') }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="entel-item">
                <header>Valoraci&oacute;n</header>
                <div class="entel-item-content">
                    <div class="fa fa-star entel-element-rating"></div>
                    <div class="fa fa-star entel-element-rating"></div>
                    <div class="fa fa-star entel-element-rating"></div>
                    <div class="fa fa-star entel-element-rating"></div>
                    <div class="fa fa-star-half-empty entel-element-rating"></div>
                    <small>
                        (4.5/5)
                    </small>
                    <br/><br/>
                    <a href="#">Ver todas</a>
                </div>
            </section>
        </div>
    </div>

</section>
@stop
@section('scripts')
<script src="//api.tiles.mapbox.com/mapbox.js/v1.5.0/mapbox.js"></script>
<script>
    (function($, benefit) {
        var geojson = [
            {
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    "coordinates": [benefit.lng, benefit.lat]
                },
                "properties": {
                    "title": benefit.nombre,
                    "description": benefit.descripcion,
                    "marker-color": "#fc4353",
                    "marker-size": "large",
                    "marker-symbol": "fast-food"
                }
            }
        ];
        var map = L.mapbox.map('map-element')
            .setView([benefit.lat, benefit.lng], 12)
            .addLayer(L.mapbox.tileLayer('juanrebolledog.gc0826d2', { detectRetina: true }));

        map.addControl(L.mapbox.geocoderControl('juanrebolledog.gc0826d2'));
        map.addControl(L.mapbox.shareControl());
        map.markerLayer.setGeoJSON(geojson);
    })(jQuery, <?= json_encode($benefit->toArray()); ?>);
</script>
@stop