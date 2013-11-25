<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('beneficios')->delete();

        Benefit::create(array(
            'nombre' => 'Test Benefit',
            'descripcion' => 'Test Benefit is for those who are feeling lonely',
            'sub_categoria_id' => 2,
            'icono' => '',
            'imagen_grande' => '',
            'imagen_chica' => '',
            'imagen_titulo' => '',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.1010,
            'lng' => -69.1234
        ));

        Benefit::create(array(
            'nombre' => 'Test Benefit 2',
            'descripcion' => 'Test Benefit is for those who are feeling sad',
            'sub_categoria_id' => 2,
            'icono' => '',
            'imagen_grande' => '',
            'imagen_chica' => '',
            'imagen_titulo' => '',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 10.2020,
            'lng' => -69.666
        ));

        Benefit::create(array(
            'nombre' => 'Super Test Benefit Turbo 2',
            'descripcion' => 'Test Benefit is for those who are feeling violent',
            'sub_categoria_id' => 2,
            'icono' => '',
            'imagen_grande' => '',
            'imagen_chica' => '',
            'imagen_titulo' => '',
            'fecha' => '',
            'lugar' => '',
            'tags' => '',
            'sms_texto' => '',
            'sms_nro' => '',
            'lat' => 11.1010,
            'lng' => -79.1234
        ));
    }
} 