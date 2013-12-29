<?php
class UserSeeder extends Seeder {
    public function run()
    {
        DB::table('usuarios')->delete();

        User::createUser(array(
            'rut' => '11222333-9',
            'telefono_movil' => '4144055232',
            'nombres' => 'Test User',
            'email' => 'test@tests.org',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));
    }
} 