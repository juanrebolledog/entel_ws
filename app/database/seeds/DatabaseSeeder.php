<?php
class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();
        $this->call('CategorySeeder');
        $this->call('UserLevelSeeder');
        $this->call('BenefitSeeder');
        $this->call('EventSeeder');
        $this->call('UserSeeder');
    }

}