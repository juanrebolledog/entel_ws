<?php
class UserLevelSeeder extends Seeder {
    public function run()
    {
        DB::table('usuarios_niveles')->delete();

        UserLevel::create(array(
            'categoria' => 'Usuario',
            'beneficios' => 0,
            'comentarios' => 0,
            'compartir' => 0,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Cachorro',
            'beneficios' => 1,
            'comentarios' => 1,
            'compartir' => 1,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'La Promesa',
            'beneficios' => 3,
            'comentarios' => 3,
            'compartir' => 3,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Explorador',
            'beneficios' => 5,
            'comentarios' => 5,
            'compartir' => 5,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Cazador',
            'beneficios' => 7,
            'comentarios' => 7,
            'compartir' => 7,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Estrella',
            'beneficios' => 9,
            'comentarios' => 9,
            'compartir' => 9,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'La Bestia',
            'beneficios' => 11,
            'comentarios' => 11,
            'compartir' => 11,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Espartano',
            'beneficios' => 13,
            'comentarios' => 13,
            'compartir' => 13,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Leyenda',
            'beneficios' => 15,
            'comentarios' => 15,
            'compartir' => 15,
            'imagen_on' => '',
            'imagen_off' => ''
        ));

        UserLevel::create(array(
            'categoria' => 'Titán',
            'beneficios' => 17,
            'comentarios' => 17,
            'compartir' => 17,
            'imagen_on' => '',
            'imagen_off' => ''
        ));
    }
}