<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('beneficios')->delete();
	    Eloquent::unguard();

        $categories = BenefitSubCategory::all();

	    $comunas = Commune::all()->take(10);

	    foreach ($comunas as $com)
	    {
		    foreach ($categories as $cat)
		    {
			    foreach (range(1, 10) as $k)
			    {
				    $benefit = Benefit::create(array(
					    'nombre' => 'Beneficio de Prueba ' . $cat->nombre,
					    'descripcion' => 'Descripción de Beneficio de Prueba. Esta es la descripción por tanto es un texto.',
					    'descripcion_larga' => 'Esta es la descripción larga',
					    'sub_categoria_id' => $cat->id,
					    'icono' => 'img/benefits/default/icono.png',
					    'imagen_grande' => 'img/benefits/default/grande.png',
					    'imagen_chica' => 'img/benefits/default/chica.png',
					    'imagen_titulo' => 'img/benefits/default/titulo.png',
					    'imagen_grande_web' => 'img/benefits/default/grande_web.png',
					    'imagen_descripcion' => 'img/benefits/default/grande.png',
					    'fecha' => 'Diciembre 2013',
					    'tags' => 'beneficio, prueba, ejemplo',
					    'sms_texto' => 'TEXT',
					    'sms_nro' => '0000',
					    'rating' => 0,
					    'legal' => 'Legal test',
					    'texto_beneficio' => '2x1 en 3 artículos',
					    'sitio_web' => 'https://www.prueba.cl',
					    'horario' => 'Lun a Vie',
					    'texto_ubicacion' => 'Este es el texto que va en ubicación',
					    'comuna_id' => $com->id
				    ));

				    foreach (range(1, 10) as $i)
				    {
					    $image = new BenefitImage(array(
						    'imagen' => 'img/benefit_images/default/imagen.png',
						    'descripcion' => 'Descripción #' . $i
					    ));
					    $benefit->images()->save($image);

					    $location = new BenefitLocation(array(
						    'lugar' => 'Estadio Municipal',
						    'lat' => 10.8053905,
						    'lng' => -69.8457396
					    ));
					    $benefit->locations()->save($location);
				    }
			    }
		    }
	    }
    }
} 