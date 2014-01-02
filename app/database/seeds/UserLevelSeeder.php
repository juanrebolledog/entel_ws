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
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/1_on.png',
            'imagen_off' => 'img/levels/default/1_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Cachorro',
            'beneficios' => 1,
            'comentarios' => 1,
            'compartir' => 1,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/2_on.png',
            'imagen_off' => 'img/levels/default/2_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'La Promesa',
            'beneficios' => 3,
            'comentarios' => 3,
            'compartir' => 3,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/3_on.png',
            'imagen_off' => 'img/levels/default/3_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Explorador',
            'beneficios' => 5,
            'comentarios' => 5,
            'compartir' => 5,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/4_on.png',
            'imagen_off' => 'img/levels/default/4_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Cazador',
            'beneficios' => 7,
            'comentarios' => 7,
            'compartir' => 7,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/5_on.png',
            'imagen_off' => 'img/levels/default/5_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Estrella',
            'beneficios' => 9,
            'comentarios' => 9,
            'compartir' => 9,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/6_on.png',
            'imagen_off' => 'img/levels/default/6_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'La Bestia',
            'beneficios' => 11,
            'comentarios' => 11,
            'compartir' => 11,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/7_on.png',
            'imagen_off' => 'img/levels/default/7_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Espartano',
            'beneficios' => 13,
            'comentarios' => 13,
            'compartir' => 13,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/8_on.png',
            'imagen_off' => 'img/levels/default/8_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Leyenda',
            'beneficios' => 15,
            'comentarios' => 15,
            'compartir' => 15,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/9_on.png',
            'imagen_off' => 'img/levels/default/9_off.png'
        ));

        UserLevel::create(array(
            'categoria' => 'Titán',
            'beneficios' => 17,
            'comentarios' => 17,
            'compartir' => 17,
            'descripcion' => 'Descripcion de nivel',
            'imagen_on' => 'img/levels/default/10_on.png',
            'imagen_off' => 'img/levels/default/10_off.png'
        ));
    }
}