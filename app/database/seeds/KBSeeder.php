<?php
class KBSeeder extends Seeder {
	public function run()
	{
		DB::table('ayuda_kb')->delete();
		Eloquent::unguard();

		$pages = array(
			array(
				'key' => 'categorias_clientes',
				'titulo' => 'CategoríAs de Clientes_',
				'cover' => 'img/kb/cover.png',
				'icono' => 'img/kb/icono.png',
				'articulos' => array(
					array(
						'titulo' => '¿Qué sOn las_categorías de clientes?',
						'texto' => 'De acuerdo a si eres cliente prepago o Suscripción y si cuánto usas los servicios Entel, puedes ir ganando más puntos mientras más hables, escribas y navegues.'
					),
					array(
						'titulo' => '¿Cuáles sOn_las categoríAs?',
						'texto' => ''
					)
				)
			),
			array(
				'key' => 'zona_puntos',
				'titulo' => 'zOna puntOs_',
				'cover' => 'img/kb/cover.png',
				'icono' => 'img/kb/icono.png',
				'articulos' => array(
					array(
						'titulo' => '¿Qué es_puntOs zOna?',
						'texto' => 'Es el nuevo sistema de beneficios de Entel para sus clientes. Te permite acumular puntos en una cuenta única asociada a tu RUT. Estos puntos pueden ser canjeados por servicios y productos Entel (bolsas, recargas, equipos o servicio técnico). Este es un servicio para todos los clientes personas de servicio de voz Entel (Prepago, Cuenta Controlada o Suscripción), mayores de 12 años de edad y cuyo su número de Cédula de Identidad sea menor a 50 millones.'
					),
					array(
						'titulo' => '¿Cómo_acumulo puntOs?',
						'texto' => ''
					)
				)
			),
			array(
				'key' => 'zona_descuentos',
				'titulo' => 'zOna DescuentOs',
				'cover' => 'img/kb/cover.png',
				'icono' => 'img/kb/icono.png',
				'articulos' => array(
					array(
						'titulo' => '¿Qué es_puntOs zOna?',
						'texto' => 'Es el nuevo sistema de beneficios de Entel para sus clientes. Te permite acumular puntos en una cuenta única asociada a tu RUT. Estos puntos pueden ser canjeados por servicios y productos Entel (bolsas, recargas, equipos o servicio técnico). Este es un servicio para todos los clientes personas de servicio de voz Entel (Prepago, Cuenta Controlada o Suscripción), mayores de 12 años de edad y cuyo su número de Cédula de Identidad sea menor a 50 millones.'
					),
					array(
						'titulo' => '¿Cómo_acumulo puntOs?',
						'texto' => ''
					)
				)
			)
		);

		foreach ($pages as $page)
		{
			$page['articulos'] = json_encode($page['articulos']);
			$new_page = new KBPage($page);
			$new_page->save();
		}
	}
} 