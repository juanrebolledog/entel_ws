@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminEventsController@index'), 'Eventos'); ?> &raquo; <?= $event->nombre; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminEventsController@edit', $event->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminEventsController@create'), 'Crear Nuevo'); ?>
            </li>
            <li>
                {{ link_to(action('AdminEventsController@delete', $event->id), 'Eliminar', array('_method' => 'DELETE', 'class' => 'ajx_link', '_cb_url' => url(action('AdminEventsController@index')))) }}
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
                        <strong>Lat.:</strong> <?= $event->lat; ?> <strong>Lng.:</strong> <?= $event->lng; ?>
                    </small>
                </div>
            </section>
            <section class="entel-item">
                <header>Descripci&oacute;n</header>
                <div class="entel-item-content">
                    <?= $event->descripcion; ?>
                </div>
            </section>
            <section class="entel-item">
                <header>Descripci&oacute;n Larga</header>
                <div class="entel-item-content">
                    <?= $event->descripcion_larga; ?>
                </div>
            </section>
            <!--
            <section class="entel-item">
                <header>Post</header>
                <div class="entel-item-content">
                    <?= $event->post; ?>
                </div>
            </section>
            -->
            <section class="entel-item">
                <header>Ubicaciones</header>
                <div class="entel-item-content">
                    <dl>
                        @foreach ($event->locations as $loc)
                        <dt>{{ $loc->lugar }} - {{ $loc->fecha }} - {{ $loc->hora }}</dt>
                        <dd>
                            {{ $loc->lat }}, {{ $loc->lng }}
                        </dd>
                        @endforeach
                    </dl>
                </div>
            </section>
            <section class="entel-item">
                <header>Sub Categor&iacute;a</header>
                <div class="entel-item-content">
                    <a href="category.html"><?= $event->sub_category->nombre; ?></a>
                </div>
            </section>
            <section class="entel-item">
                <header>SMS</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>Nro</dt>
                        <dd><?= $event->sms_nro; ?></dd>
                        <dt>Texto</dt>
                        <dd><?= $event->sms_texto; ?></dd>
                    </dl>
                </div>
            </section>
            <section class="entel-item">
                <header>Tags</header>
                <div class="entel-item-content">
                    <?php foreach (explode(',', $event->tags) as $tag): ?>
                    <span class="round label"><?= trim($tag); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
        <div class="large-7 medium-6 small-12 columns">
            <section class="entel-item">
                <header>Im&aacute;genes</header>
                <div class="entel-item-content">
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_grande); ?>" alt="">
                        <header>
                            Grande / 800x200 / <?= asset($event->imagen_grande); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_chica); ?>" alt="">
                        <header>
                            Chica / 500x100 / <?= asset($event->imagen_chica); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->icono); ?>" alt="">
                        <header>
                            &Iacute;cono / 256x256 / <?= asset($event->icono); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_titulo); ?>" alt="">
                        <header>
                            T&iacute;tulo / 800x50 / <?= asset($event->imagen_titulo); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_grande_web); ?>" alt="">
                        <header>
                            Grande Web / 800x173 / <?= asset($event->imagen_grande_web); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_ubicacion); ?>" alt="">
                        <header>
                            Ubicaci&oacute;n / 800x173 / <?= asset($event->imagen_ubicacion); ?>
                        </header>
                    </div>
                    <div class="entel-image">
                        <img src="<?= asset($event->imagen_bg); ?>" alt="">
                        <header>
                            Fondo / 800x173 / <?= asset($event->imagen_bg); ?>
                        </header>
                    </div>
                </div>
            </section>
        </div>
    </div>

</section>
@stop
@section('scripts')
<script src="//api.tiles.mapbox.com/mapbox.js/v1.5.0/mapbox.js"></script>
<script>
    (function($, event) {
        var geojson = [
            {
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    "coordinates": [event.lng, event.lat]
                },
                "properties": {
                    "title": event.nombre,
                    "description": event.descripcion,
                    "marker-color": "#fc4353",
                    "marker-size": "large",
                    "marker-symbol": "fast-food"
                }
            }
        ];
        var map = L.mapbox.map('map-element')
            .setView([event.lat, event.lng], 12)
            .addLayer(L.mapbox.tileLayer('juanrebolledog.gc0826d2', { detectRetina: true }));

        map.addControl(L.mapbox.geocoderControl('juanrebolledog.gc0826d2'));
        map.addControl(L.mapbox.shareControl());
        map.markerLayer.setGeoJSON(geojson);
    })(jQuery, <?= json_encode($event->toArray()); ?>);
</script>
@stop