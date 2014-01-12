<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('beneficios')->delete();

        $categories = BenefitSubCategory::all();

        foreach ($categories as $cat)
        {
            foreach (range(1, 2) as $k)
            {
                Benefit::create(array(
                    'nombre' => 'Beneficio de Prueba ' . $cat->nombre,
                    'descripcion' => 'Descripción de Beneficio de Prueba. Esta es la descripción por tanto es un texto.',
                    'sub_categoria_id' => $cat->id,
                    'icono' => 'http://lorempixel.com/64/64/fashion',
                    'imagen_grande' => 'http://lorempixel.com/535/173/fashion',
                    'imagen_chica' => 'http://lorempixel.com/235/163/fashion',
                    'imagen_titulo' => 'http://lorempixel.com/535/173/fashion',
                    'imagen_grande_web' => 'http://lorempixel.com/800/173/fashion',
                    'imagen_descripcion' => 'http://lorempixel.com/535/100/fashion',
                    'fecha' => 'Diciembre 2013',
                    'lugar' => 'Estadio Municipal',
                    'tags' => 'beneficio, prueba, ejemplo',
                    'sms_texto' => 'TEXT',
                    'sms_nro' => '0000',
                    'lat' => 10.8053905 + rand(-10, 10),
                    'lng' => -69.8457396 + rand(-10, 10),
                    'rating' => 0,
                    'legal' => 'Legal test',
                    'texto_beneficio' => '2x1 en 3 artículos',
                    'sitio_web' => 'https://www.prueba.cl',
                    'horario' => 'Lun a Vie',
                    'texto_ubicacion' => 'Este es el texto que va en ubicación'
                ));
            }
        }
    }
} 