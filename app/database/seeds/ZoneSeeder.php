<?php
class ZoneSeeder extends Seeder {
    public function run()
    {
        DB::table('puntos_zonas_categorias')->delete();
        DB::table('puntos_zonas')->delete();

        ZoneCategory::create(array(
            'nombre' => 'Entretención'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $zone = new Zone();
            $zone->nombre = 'Punto Zona ' . $k;
            $zone->url = 'https://www.google.com/';
            $zone->imagen = 'img/zones/default/imagen.png';
            $zone->imagen_web = 'img/zones/default/imagen_web.png';

            ZoneCategory::where('nombre', 'Entretención')->first()->zones()->save($zone);
        }

        ZoneCategory::create(array(
            'nombre' => 'Bolsas'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $zone = new Zone();
            $zone->nombre = 'Punto Zona ' . $k;
            $zone->url = 'https://www.google.com/';
            $zone->imagen = 'img/zones/default/imagen.png';
            $zone->imagen_web = 'img/zones/default/imagen_web.png';

            ZoneCategory::where('nombre', 'Bolsas')->first()->zones()->save($zone);
        }

        ZoneCategory::create(array(
            'nombre' => 'Recarga'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $zone = new Zone();
            $zone->nombre = 'Punto Zona ' . $k;
            $zone->url = 'https://www.google.com/';
            $zone->imagen = 'img/zones/default/imagen.png';
            $zone->imagen_web = 'img/zones/default/imagen_web.png';

            ZoneCategory::where('nombre', 'Recarga')->first()->zones()->save($zone);
        }

        ZoneCategory::create(array(
            'nombre' => 'Televisión'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $zone = new Zone();
            $zone->nombre = 'Punto Zona ' . $k;
            $zone->url = 'https://www.google.com/';
            $zone->imagen = 'img/zones/default/imagen.png';
            $zone->imagen_web = 'img/zones/default/imagen_web.png';

            ZoneCategory::where('nombre', 'Televisión')->first()->zones()->save($zone);
        }
    }
} 