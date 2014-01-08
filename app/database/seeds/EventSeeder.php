<?php
class EventSeeder extends Seeder {
    public function run()
    {
        DB::table('eventos')->delete();

        $categories = EventSubCategory::all();

        foreach ($categories as $k=>$cat)
        {
            foreach (array(1, 2, 3, 4, 5, 6) as $j)
            {
                AppEvent::create(array(
                    'nombre' => 'Test Event ' . $j . ' ' . $cat->nombre,
                    'descripcion' => 'Test Event is for those who are feeling good',
                    'sub_categoria_id' => $cat->id,
                    'icono' => 'img/events/default/icono.png',
                    'imagen_grande' => 'img/events/default/grande.png',
                    'imagen_chica' => 'img/events/default/chica.png',
                    'imagen_titulo' => 'img/events/default/titulo.png',
                    'imagen_grande_web' => 'img/events/default/grande_web.png',
                    'fecha' => 'Diciembre ' . (string)((int)date('Y') + $k),
                    'lugar' => 'Estadio Municipal',
                    'tags' => 'evento, prueba, ejemplo',
                    'sms_texto' => 'TEXT',
                    'sms_nro' => '0000',
                    'lat' => 10.8053905 + rand(-10, 10),
                    'lng' => -69.8053905 + rand(-10, 10),
                    'legal' => 'Legal test'
                ));
            }
        }
    }
} 