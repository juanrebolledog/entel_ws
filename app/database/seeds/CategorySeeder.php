<?php
class CategorySeeder extends Seeder {
    public function run()
    {
        DB::table('categorias_beneficios')->delete();
        DB::table('sub_categorias_beneficios')->delete();

        BenefitCategory::create(array(
            'nombre' => 'Entretención',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        BenefitCategory::create(array(
            'nombre' => 'Deporte',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        $sub_category = new BenefitSubCategory(array(
            'nombre' => 'Fútbol',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        BenefitCategory::where('nombre', 'Deporte')->first()->sub_categories()->save($sub_category);

        $sub_category = new BenefitSubCategory(array(
            'nombre' => 'Ski',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        BenefitCategory::where('nombre', 'Deporte')->first()->sub_categories()->save($sub_category);

        BenefitCategory::create(array(
            'nombre' => 'Gastronomía',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        BenefitCategory::create(array(
            'nombre' => 'Otros',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        DB::table('categorias_eventos')->delete();
        DB::table('sub_categorias_eventos')->delete();

        EventCategory::create(array(
            'nombre' => 'Entel en Vivo',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        $sub_category = new EventSubCategory(array(
            'nombre' => 'Música',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        EventCategory::where('nombre', 'Entel en Vivo')->first()->sub_categories()->save($sub_category);

        $sub_category = new EventSubCategory(array(
            'nombre' => 'Fiestas',
            'banner' => '',
            'banner_link' => '',
            'icono' => '',
            'created_at' => '2013-12-25 00:00:00',
            'updated_at' => '2013-12-25 00:00:00'
        ));

        EventCategory::where('nombre', 'Entel en Vivo')->first()->sub_categories()->save($sub_category);
    }
} 