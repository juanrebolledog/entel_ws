<?php
class CategorySeeder extends Seeder {
    public function run()
    {
        DB::table('categorias_beneficios')->delete();
        DB::table('sub_categorias_beneficios')->delete();

        BenefitCategory::create(array(
            'nombre' => 'Entretención',
            'banner' => 'img/benefit_categories/default/banner.png',
            'icono' => 'img/benefit_categories/default/icono.png',
            'banner_link' => ''
        ));

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Entretención',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Entretención')->first()->sub_categories()->save($sub_category);

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Cine',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Entretención')->first()->sub_categories()->save($sub_category);

        BenefitCategory::create(array(
            'nombre' => 'Deporte',
            'banner' => 'img/benefit_categories/default/banner.png',
            'icono' => 'img/benefit_categories/default/icono.png',
            'banner_link' => ''
        ));

        $sub_category = new BenefitSubCategory(array(
            'nombre' => 'Fútbol',
            'banner' => 'img/benefit_sub_categories/default/banner.png',
            'icono' => 'img/benefit_sub_categories/default/icono.png',
            'banner_link' => ''
        ));

        BenefitCategory::where('nombre', 'Deporte')->first()->sub_categories()->save($sub_category);

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Gimnasio y deporte',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Deporte')->first()->sub_categories()->save($sub_category);

        $sub_category = new BenefitSubCategory(array(
            'nombre' => 'Ski',
            'banner' => 'img/benefit_sub_categories/default/banner.png',
            'icono' => 'img/benefit_sub_categories/default/icono.png',
            'banner_link' => ''
        ));

        BenefitCategory::where('nombre', 'Deporte')->first()->sub_categories()->save($sub_category);

        BenefitCategory::create(array(
            'nombre' => 'Gastronomía',
            'banner' => 'img/benefit_categories/default/banner.png',
            'icono' => 'img/benefit_categories/default/icono.png',
            'banner_link' => ''
        ));

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Fastfood',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Gastronomía')->first()->sub_categories()->save($sub_category);

        BenefitCategory::create(array(
            'nombre' => 'Otros',
            'banner' => 'img/benefit_categories/default/banner.png',
            'icono' => 'img/benefit_categories/default/icono.png',
            'banner_link' => ''
        ));

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Seguros',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Otros')->first()->sub_categories()->save($sub_category);

	    $sub_category = new BenefitSubCategory(array(
		    'nombre' => 'Farmacias',
		    'banner' => 'img/benefit_sub_categories/default/banner.png',
		    'icono' => 'img/benefit_sub_categories/default/icono.png',
		    'banner_link' => ''
	    ));

	    BenefitCategory::where('nombre', 'Otros')->first()->sub_categories()->save($sub_category);

        DB::table('categorias_eventos')->delete();
        DB::table('sub_categorias_eventos')->delete();

        EventCategory::create(array(
            'nombre' => 'Entel en Vivo',
            'banner' => 'img/event_categories/default/banner.png',
            'icono' => 'img/event_categories/default/icono.png',
            'banner_link' => ''
        ));

        $sub_category = new EventSubCategory(array(
            'nombre' => 'Música',
            'banner' => 'img/event_sub_categories/default/banner.png',
            'icono' => 'img/event_sub_categories/default/icono.png',
            'banner_link' => ''
        ));

        EventCategory::where('nombre', 'Entel en Vivo')->first()->sub_categories()->save($sub_category);

        $sub_category = new EventSubCategory(array(
            'nombre' => 'Fiestas',
            'banner' => 'img/event_sub_categories/default/banner.png',
            'icono' => 'img/event_sub_categories/default/icono.png',
            'banner_link' => ''
        ));

        EventCategory::where('nombre', 'Entel en Vivo')->first()->sub_categories()->save($sub_category);
    }
} 