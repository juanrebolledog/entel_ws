<?php
class CategorySeeder extends Seeder {
    public function run()
    {
        DB::table('categorias_beneficios')->delete();

        BenefitCategory::create(array(
            'nombre' => 'Deportes',
            'banner' => '',
            'banner_link' => '',
            'icono' => ''
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

        BenefitSubCategory::create(array(
            'categoria_id' => 2,
            'nombre' => 'Burger King',
            'banner' => '',
            'banner_link' => ''
        ));
    }
} 