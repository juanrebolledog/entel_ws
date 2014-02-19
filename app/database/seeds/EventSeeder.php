<?php
class EventSeeder extends Seeder {
    public function run()
    {
        DB::table('eventos')->delete();
	    Eloquent::unguard();

        $categories = EventSubCategory::all();

        foreach ($categories as $k=>$cat)
        {
            foreach (range(1, 10) as $j)
            {
                $e = AppEvent::create(array(
                    'nombre' => 'Evento de Prueba ' . $cat->nombre,
	                'mini_texto' => '10% DCTO.',
                    'descripcion' => 'Este es una prueba. Un Evento que realmente no sucederá.',
                    'descripcion_larga' => 'Este es una prueba. Un Evento que realmente no sucederá. Esta es la descripción larga.',
                    'sub_categoria_id' => $cat->id,
                    'icono' => 'img/events/default/icono.png',
                    'imagen_grande' => 'img/events/default/grande.png',
                    'imagen_chica' => 'img/events/default/chica.png',
                    'imagen_titulo' => 'img/events/default/titulo.png',
                    'imagen_grande_web' => 'img/events/default/grande_web.png',
                    'imagen_ubicacion' => 'img/events/default/ubicacion.png',
                    'imagen_bg' => 'img/events/default/bg.png',
                    'tags' => 'evento, prueba, ejemplo',
                    'sms_texto' => 'TEXT',
                    'sms_nro' => '954',
                    'legal' => 'Legal test',
                    'post' => 'Este es el post que va en el Evento. En el se puede hacer una larga descripción o hablar de otros temas referentes al Evento'
                ));

	            foreach (range(1, 5) as $i)
	            {
					$location = new EventLocation();
		            $location->lugar = 'Estadio Municipal #' . $i;
		            $location->lat = 10.8053905 + rand(-10, 10);
		            $location->lng = -69.8053905 + rand(-10, 10);
		            $e->location()->save($location);
	            }

	            foreach (range(1, 5) as $i)
	            {
		            $date = new EventDate();
		            $date->fecha = date('Y-m-d', strtotime('+' . $i . ' week'));
		            $e->dates()->save($date);
	            }

                foreach (range(1, 5) as $i)
                {
                    $image = new EventImage();
                    $image->descripcion = 'Test Imagen ' . $i . ' descripción';
                    $image->imagen = 'img/event_images/default/imagen.png';
                    $e->images()->save($image);
                }

                foreach (range(1, 5) as $i)
                {
                    $video = new EventVideo();
                    $video->descripcion = 'Test Video ' . $i . ' descripción';
                    $video->url = 'C0DPdy98e4c';
                    $e->videos()->save($video);
                }
            }
        }
    }
} 