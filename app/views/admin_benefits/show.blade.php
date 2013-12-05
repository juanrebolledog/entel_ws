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
        <div class="large-5 medium-6 small-12 columns">
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
                    <a href="category.html">Comida R&aacute;pida</a>
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
                </div>
                <br/>
                <div class="entel-item-content">
                    <a href="#" class="button secondary small">&raquo; ver &uacute;ltimas valoraciones</a>
                </div>
                <div class="entel-item-content entel-latest-ratings hide">
                    <h4>&Uacute;ltimas valoraciones</h4>
                    <table>
                        <thead>
                        <tr>
                            <th>Valoraci&oacute;n</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>5</td>
                            <td>2013-11-22 01:10:34</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>2013-11-21 16:45:11</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>2013-11-19 10:23:01</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="entel-item">
                <header>Mas Info.</header>
                <div class="entel-item-content">
                    <small>[vac&iacute;o]</small>
                </div>
            </section>
        </div>
        <div class="large-7 medium-6 small-12 columns">
            <section class="entel-item">
                <header>Im&aacute;genes</header>
                <div class="entel-item-content">
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_grande); ?>" alt="">
                        <header>
                            Grande / 800x200 / https://cdn.example.com/<?= $benefit->imagen_grande; ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_chica); ?>" alt="">
                        <header>
                            Chica / 500x100 / https://cdn.example.com/<?= $benefit->imagen_chica; ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->icono); ?>" alt="">
                        <header>
                            &Iacute;cono / 256x256 / https://cdn.example.com/<?= $benefit->icono; ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($benefit->imagen_titulo); ?>" alt="">
                        <header>
                            T&iacute;tulo / 800x50 / https://cdn.example.com/<?= $benefit->imagen_titulo; ?>
                        </header>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="large-12 medium-12 small-12">
            <section class="entel-item">
                <header>Comentarios</header>
                <div class="entel-item-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Mensaje</th>
                            <th>Fecha &#x21e3</th>
                            <th class="hide-for-small">Compartir FB</th>
                            <th class="hide-for-small">Compartir Tw</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
        var map = L.mapbox.map('map-element', 'juanrebolledog.gc0826d2')
            .setView([benefit.lat, benefit.lng], 12);

        map.addControl(L.mapbox.geocoderControl('juanrebolledog.gc0826d2'));
        map.addControl(L.mapbox.shareControl());
        map.markerLayer.setGeoJSON(geojson);
    })(jQuery, <?= json_encode($benefit->toArray()); ?>);
</script>
@stop