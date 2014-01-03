<?php
class ZoneSeeder extends Seeder {
    public function run()
    {
        DB::table('puntos_zonas')->delete();

        Zone::create(array(
            'nombre' => 'Punto Zona 1',
            'url' => 'https://www.google.com/',
            'imagen' => 'img/zones/default/zone.png'
        ));

        Zone::create(array(
            'nombre' => 'Punto Zona 2',
            'url' => 'https://www.google.com/',
            'imagen' => 'img/zones/default/zone.png'
        ));

        Zone::create(array(
            'nombre' => 'Punto Zona 3',
            'url' => 'https://www.google.com/',
            'imagen' => 'img/zones/default/zone.png'
        ));
    }
} 