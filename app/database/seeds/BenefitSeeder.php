<?php
class BenefitSeeder extends Seeder {
    public function run()
    {
        DB::table('benefits')->delete();

        Benefit::create(array(
            'name' => 'Test Benefit',
            'description' => 'Test Benefit is for those who are feeling lonely',
            'category_id' => 1,
            'lat' => 10.1010,
            'lng' => -69.1234
        ));

        Benefit::create(array(
            'name' => 'Test Benefit 2',
            'description' => 'Test Benefit is for those who are feeling sad',
            'category_id' => 1,
            'lat' => 10.2020,
            'lng' => -69.666
        ));

        Benefit::create(array(
            'name' => 'Super Test Benefit Turbo 2',
            'description' => 'Test Benefit is for those who are feeling violent',
            'category_id' => 1,
            'lat' => 11.1010,
            'lng' => -79.1234
        ));
    }
} 