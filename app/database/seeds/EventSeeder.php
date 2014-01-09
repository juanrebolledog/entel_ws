<?php
class EventSeeder extends Seeder {
    public function run()
    {
        DB::table('eventos')->delete();

        $categories = EventSubCategory::all();

        foreach ($categories as $k=>$cat)
        {
            foreach (array(1, 2) as $j)
            {
                $e = AppEvent::create(array(
                    'nombre' => 'Evento de Prueba',
                    'descripcion' => 'Este es una prueba. Un Evento que realmente no sucederá.',
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

                foreach (array(1, 2) as $i)
                {
                    $image = new EventImage();
                    $image->descripcion = 'Test Image Description';
                    $image->imagen = 'img/events/default/grande_web.png';
                    $e->images()->save($image);
                }
            }
        }
    }
} 