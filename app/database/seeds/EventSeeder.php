<?php
class EventSeeder extends Seeder {
    public function run()
    {
        DB::table('eventos')->delete();

        $categories = EventSubCategory::all();

        foreach ($categories as $k=>$cat)
        {
            AppEvent::create(array(
                'nombre' => 'Test Event 1 ' . $cat->nombre,
                'descripcion' => 'Test Event is for those who are feeling good',
                'sub_categoria_id' => $cat->id,
                'icono' => 'img/events/default/icono.png',
                'imagen_grande' => 'img/events/default/grande.png',
                'imagen_chica' => 'img/events/default/chica.png',
                'imagen_titulo' => 'img/events/default/titulo.png',
                'fecha' => 'Diciembre ' . (int)date('Y') + $k,
                'lugar' => 'Estadio Municipal',
                'tags' => 'evento, prueba, ejemplo',
                'sms_texto' => 'TEXT',
                'sms_nro' => '0000',
                'lat' => 10.8053905,
                'lng' => -69.8053905,
                'legal' => 'Legal test'
            ));

            AppEvent::create(array(
                'nombre' => 'Test Event 2 ' . $cat->nombre,
                'descripcion' => 'Test Event is for those who are feeling ok',
                'sub_categoria_id' => $cat->id,
                'icono' => 'img/events/default/icono.png',
                'imagen_grande' => 'img/events/default/grande.png',
                'imagen_chica' => 'img/events/default/chica.png',
                'imagen_titulo' => 'img/events/default/titulo.png',
                'fecha' => 'Diciembre ' . (int)date('Y') + $k,
                'lugar' => 'Estadio Municipal',
                'tags' => 'evento, prueba, ejemplo',
                'sms_texto' => 'TEXT',
                'sms_nro' => '0000',
                'lat' => 10.9053905,
                'lng' => -69.9053905,
                'legal' => 'Legal test'
            ));
        }
    }
} 