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
                    'descripcion_larga' => 'Este es una prueba. Un Evento que realmente no sucederá. Esta es la descripción larga.',
                    'sub_categoria_id' => $cat->id,
                    'icono' => 'https://lorempixel.com/64/64/nightlife',
                    'imagen_grande' => 'https://lorempixel.com/535/173/nightlife',
                    'imagen_chica' => 'https://lorempixel.com/262/136/nightlife',
                    'imagen_titulo' => 'https://lorempixel.com/535/173/nightlife',
                    'imagen_grande_web' => 'https://lorempixel.com/800/173/nightlife',
                    'imagen_ubicacion' => 'https://lorempixel.com/800/300/nightlife',
                    'imagen_bg' => 'https://lorempixel.com/1024/768/nightlife',
                    'fecha' => new DateTime(),
                    'lugar' => 'Estadio Municipal',
                    'tags' => 'evento, prueba, ejemplo',
                    'sms_texto' => 'TEXT',
                    'sms_nro' => '0000',
                    'lat' => 10.8053905 + rand(-10, 10),
                    'lng' => -69.8053905 + rand(-10, 10),
                    'legal' => 'Legal test',
                    'post' => 'Este es el post que va en el Evento. En el se puede hacer una larga descripción o hablar de otros temas referentes al Evento'
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