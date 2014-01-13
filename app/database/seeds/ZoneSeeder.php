<?php
class ZoneSeeder extends Seeder {
    public function run()
    {
        DB::table('puntos_zonas_categorias')->delete();
        DB::table('puntos_zonas_sub_categorias')->delete();
        DB::table('puntos_zonas')->delete();

        $cat = ZoneCategory::create(array(
            'nombre' => 'Bolsas'
        ));

        $sub_cats = array(
            'Voz', 'Mensajes', 'Datos', 'Mixtas'
        );

        foreach ($sub_cats as $k)
        {
            $sub_cat = new ZoneSubCategory();
            $sub_cat->nombre = $k;
            $sub_cat->imagen_icono = 'img/zone_sub_categories/default/icono.png';

            $cat->sub_categories()->save($sub_cat);

            foreach (range(1, 5) as $j)
            {
                $zone = new Zone();
                $zone->nombre = 'Punto #' . $j;
                $zone->url = 'https://zona.entel.cl/';
                $zone->imagen = 'img/zones/default/imagen.png';
                $zone->imagen_web = 'img/zones/default/imagen_web.png';
                $zone->cantidad = $j * 100;
                $zone->vigencia = $j . ' días';

                $sub_cat->zones()->save($zone);
            }
        }

        $cat = ZoneCategory::create(array(
            'nombre' => 'Recargas'
        ));

        $sub_cats = array(
            'Recargas'
        );

        foreach ($sub_cats as $k)
        {
            $sub_cat = new ZoneSubCategory();
            $sub_cat->nombre = $k;
            $sub_cat->imagen_icono = 'img/zone_sub_categories/default/icono.png';

            $cat->sub_categories()->save($sub_cat);

            foreach (range(1, 5) as $j)
            {
                $zone = new Zone();
                $zone->nombre = 'Punto #' . $j;
                $zone->url = 'https://zona.entel.cl/';
                $zone->imagen = 'img/zones/default/imagen.png';
                $zone->imagen_web = 'img/zones/default/imagen_web.png';
                $zone->cantidad = $j * 100;
                $zone->vigencia = $j . ' días';

                $sub_cat->zones()->save($zone);
            }
        }
    }
} 