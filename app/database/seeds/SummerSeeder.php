<?php
class SummerSeeder extends Seeder {
    public function run()
    {
        DB::table('veranos_categorias')->delete();
        DB::table('veranos')->delete();

        $cat = SummerCategory::create(array(
            'nombre' => 'Promociones'
        ));

        foreach (range(1, 10) as $i)
        {
            $summer = new Summer(array(
                'nombre' => 'Prueba Verano #' . $i,
                'descripcion' => 'Esta es una prueba de Verano, esta es la descripción',
                'descripcion_larga' => 'Esta es una prueba de Verano, esta es la descripción larga',
                'texto_beneficio' => '2x1 en Verano #' . $i,
                'horario' => '10:00',
                'lugar' => 'La Luna',
                'fecha' => new DateTime(),
                'legal' => 'Bases legales de prueba',
                'sms_nro' => '1001',
                'sms_texto' => 'LUNA',
                'imagen_descripcion' => 'img/summers/default/descripcion.png',
                'imagen_titulo' => 'img/summers/default/titulo.png'
            ));
            $cat->summers()->save($summer);
        }

        $cat = SummerCategory::create(array(
            'nombre' => 'Fiestas'
        ));

        foreach (range(1, 10) as $i)
        {
            $summer = new Summer(array(
                'nombre' => 'Prueba Verano #' . $i,
                'descripcion' => 'Esta es una prueba de Verano, esta es la descripción',
                'descripcion_larga' => 'Esta es una prueba de Verano, esta es la descripción larga',
                'texto_beneficio' => '2x1 en Verano #' . $i,
                'horario' => '10:00',
                'lugar' => 'La Luna',
                'fecha' => new DateTime(),
                'legal' => 'Bases legales de prueba',
                'sms_nro' => '1001',
                'sms_texto' => 'LUNA',
                'imagen_descripcion' => 'img/summers/default/descripcion.png',
                'imagen_titulo' => 'img/summers/default/titulo.png'
            ));
            $cat->summers()->save($summer);
        }

        $cat = SummerCategory::create(array(
            'nombre' => 'Entretención'
        ));

        foreach (range(1, 10) as $i)
        {
            $summer = new Summer(array(
                'nombre' => 'Prueba Verano #' . $i,
                'descripcion' => 'Esta es una prueba de Verano, esta es la descripción',
                'descripcion_larga' => 'Esta es una prueba de Verano, esta es la descripción larga',
                'texto_beneficio' => '2x1 en Verano #' . $i,
                'horario' => '10:00',
                'lugar' => 'La Luna',
                'fecha' => new DateTime(),
                'legal' => 'Bases legales de prueba',
                'sms_nro' => '1001',
                'sms_texto' => 'LUNA',
                'imagen_descripcion' => 'img/summers/default/descripcion.png',
                'imagen_titulo' => 'img/summers/default/titulo.png'
            ));
            $cat->summers()->save($summer);
        }
    }
} 