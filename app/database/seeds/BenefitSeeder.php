<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('beneficios')->delete();

        $categories = BenefitSubCategory::all();

        foreach ($categories as $cat)
        {
            foreach (array(1, 2) as $k)
            {
                Benefit::create(array(
                    'nombre' => 'Super Test Benefit ' . $cat->nombre,
                    'descripcion' => 'Test Benefit is for those who are feeling good',
                    'sub_categoria_id' => $cat->id,
                    'icono' => 'img/benefits/default/icono.png',
                    'imagen_grande' => 'img/benefits/default/grande.png',
                    'imagen_chica' => 'img/benefits/default/chica.png',
                    'imagen_titulo' => 'img/benefits/default/titulo.png',
                    'imagen_grande_web' => 'img/events/default/grande_web.png',
                    'fecha' => 'Diciembre 2013',
                    'lugar' => 'Estadio Municipal',
                    'tags' => 'beneficio, prueba, ejemplo',
                    'sms_texto' => 'TEXT',
                    'sms_nro' => '0000',
                    'lat' => 10.8053905 + rand(-10, 10),
                    'lng' => -69.8457396 + rand(-10, 10),
                    'rating' => 0,
                    'legal' => 'Legal test'
                ));
            }
        }
    }
} 