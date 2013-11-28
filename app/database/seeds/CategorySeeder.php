<?php
class CategorySeeder extends Seeder {
    public function run()
    {
        DB::table('categorias_beneficios')->delete();
        DB::table('sub_categorias_beneficios')->delete();

        BenefitCategory::create(array(
            'nombre' => 'Deportes',
            'banner' => '',
            'banner_link' => '',
            'icono' => ''
        ));

        $sub_category = new BenefitSubCategory(array(
            'nombre' => 'Burger King',
            'banner' => '',
            'banner_link' => ''
        ));

        BenefitCategory::create(array(
            'nombre' => 'Gastronomía',
            'banner' => '',
            'banner_link' => '',
            'icono' => ''
        ));

        BenefitCategory::create(array(
            'nombre' => 'Otros',
            'banner' => '',
            'banner_link' => '',
            'icono' => ''
        ));

        BenefitCategory::where('nombre', 'Gastronomía')->first()->sub_categories()->save($sub_category);
    }
} 