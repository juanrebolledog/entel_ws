<?php
class EventSeeder extends Seeder {
    public function run()
    {
        DB::table('eventos')->delete();

        $cat = EventSubCategory::first();

        AppEvent::create(array(
            'nombre' => 'Test Event',
            'descripcion' => 'Test Event is for those who are feeling lonely',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/events/default/icono.png',
            'imagen_grande' => 'img/events/default/grande.png',
            'imagen_chica' => 'img/events/default/chica.png',
            'imagen_titulo' => 'img/events/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.1010,
            'lng' => -69.1234,
            'legal' => 'Legal test'
        ));

        AppEvent::create(array(
            'nombre' => 'Test Event 2',
            'descripcion' => 'Test Event is for those who are feeling sad',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/events/default/icono.png',
            'imagen_grande' => 'img/events/default/grande.png',
            'imagen_chica' => 'img/events/default/chica.png',
            'imagen_titulo' => 'img/events/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.2020,
            'lng' => -69.666,
            'legal' => 'Legal test'
        ));

        AppEvent::create(array(
            'nombre' => 'Super Test Event Turbo 2',
            'descripcion' => 'Test Event is for those who are feeling violent',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/events/default/icono.png',
            'imagen_grande' => 'img/events/default/grande.png',
            'imagen_chica' => 'img/events/default/chica.png',
            'imagen_titulo' => 'img/events/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 11.1010,
            'lng' => -79.1234,
            'legal' => 'Legal test'
        ));
    }
} 