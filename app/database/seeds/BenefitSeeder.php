<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('beneficios')->delete();

        $cat = BenefitSubCategory::first();

        Benefit::create(array(
            'nombre' => 'Test Benefit',
            'descripcion' => 'Test Benefit is for those who are feeling lonely',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/benefits/default/icono.png',
            'imagen_grande' => 'img/benefits/default/grande.png',
            'imagen_chica' => 'img/benefits/default/chica.png',
            'imagen_titulo' => 'img/benefits/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.1010,
            'lng' => -69.1234,
            'rating' => 0,
            'legal' => 'Legal test'
        ));

        Benefit::create(array(
            'nombre' => 'Test Benefit 2',
            'descripcion' => 'Test Benefit is for those who are feeling sad',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/benefits/default/icono.png',
            'imagen_grande' => 'img/benefits/default/grande.png',
            'imagen_chica' => 'img/benefits/default/chica.png',
            'imagen_titulo' => 'img/benefits/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.2020,
            'lng' => -69.666,
            'rating' => 0,
            'legal' => 'Legal test'
        ));

        Benefit::create(array(
            'nombre' => 'Super Test Benefit Turbo 2',
            'descripcion' => 'Test Benefit is for those who are feeling violent',
            'sub_categoria_id' => $cat->id,
            'icono' => 'img/benefits/default/icono.png',
            'imagen_grande' => 'img/benefits/default/grande.png',
            'imagen_chica' => 'img/benefits/default/chica.png',
            'imagen_titulo' => 'img/benefits/default/titulo.png',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 11.1010,
            'lng' => -79.1234,
            'rating' => 0,
            'legal' => 'Legal test'
        ));
    }
} 