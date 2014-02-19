<?php
class PuntosZonaContentSeeder extends Seeder {
	public function run()
	{
		DB::table('pages')->delete();
		Eloquent::unguard();

		$pages = array(
			array(
				'key' => 'puntos_que_es',
				'titulo' => '¿Qué es_ PUNTOS ZONA?',
				'texto_descripcion' => 'Puntos zOna es un medio de canje a tus beneficios de zOna entel_',
				'texto_descripcion_alt' => 'Revisa el vencimiento de tus puntos zOna y más información de tu cartola en Mi Entel.',
				'obj_debes_saber' => '',
				'obj_contenido' => array(
					array(
						'titulo' => 'AcumulA_',
						'icono' => 'img/zonas_content/que_es_icono.png',
						'texto' => 'Todo lo que hablas, escribes o navegas suma más puntos. Revisa tu categoría y verás cuánto acumulas.'
					),
					array(
						'titulo' => 'Canje_',
						'icono' => 'img/zonas_content/que_es_icono.png',
						'texto' => 'Todos los puntos que acumulas los puedes canjear por cualquier producto entel considerando que 1 punto = $1.'
					),
					array(
						'titulo' => 'VentajAs_',
						'icono' => 'img/zonas_content/que_es_icono.png',
						'texto' => 'Tus puntos son flexibles, puedes canjear productos sólo con puntos o puntos más plata. Tus puntos duran 24 meses.'
					)
				)
			),
			array(
				'key' => 'puntos_que_canjear',
				'titulo' => '¿Qué puedo_ CANJEAR?',
				'texto_descripcion' => 'Estos son los productos y servicios que puedes canjer con tus puntos zOna_',
				'texto_descripcion_alt' => '',
				'obj_debes_saber' => '',
				'obj_contenido' => array(
					array(
						'titulo' => 'EquipOs_',
						'icono' => 'img/zonas_content/que_canjear_icono.png',
						'link' => array(),
						'super_titulo' => 'COMBÍNALOS COMO QUIERAS, SOLO PUNTOS O PUNTOS + DINERO, PORQUE 1 PUNTO=$1',
						'texto' => 'El canje de equipos lo puedes realizar en cualquiera de nuestas tiendas y Tiendas Express.'
					),
					array(
						'titulo' => 'RecargAs_',
						'icono' => 'img/zonas_content/que_canjear_icono.png',
						'link' => array(),
						'super_titulo' => '',
						'texto' => 'El canje de equipos lo puedes realizar en cualquiera de nuestas tiendas y Tiendas Express.'
					),
					array(
						'titulo' => 'BolsAs_',
						'icono' => 'img/zonas_content/que_canjear_icono.png',
						'link' => array(
							'texto' => 'Descúbrelas aquí',
							'href' => '#'
						),
						'super_titulo' => '',
						'texto' => 'El canje de equipos lo puedes realizar en Mi Entel o llamando al 103 opción 5 y 301 opción 3.'
					),
					array(
						'titulo' => 'TarjetA sim_',
						'icono' => 'img/zonas_content/que_canjear_icono.png',
						'link' => array(),
						'super_titulo' => '',
						'texto' => 'El canje de equipos lo puedes realizar en cualquiera de nuestas tiendas y Tiendas Express.'
					),
					array(
						'titulo' => 'ServiciO técnicO_',
						'icono' => 'img/zonas_content/que_canjear_icono.png',
						'link' => array(),
						'super_titulo' => '',
						'texto' => 'El canje de equipos lo puedes realizar en cualquiera de nuestas tiendas y Tiendas Express.'
					)
				)
			),
			array(
				'key' => 'puntos_donde_canjear',
				'titulo' => '¿Dónde canjeo_ MIS PUNTOS?',
				'texto_descripcion' => 'Puedes canjear en: web, tiendas, tiendas express y opciones automáticas.',
				'texto_descripcion_alt' => '',
				'obj_debes_saber' => array(
					'Tus puntos son medio de pago a una conversión simple de 1 punto = $1.',
					'No existe mínimo de puntos para canje',
					'Flexibilidad de los puntos, puedes pagar con puntos.',
					'Tus puntos tienen una vigencia de 24 meses.'
				),
				'obj_contenido' => array(
					array(
						'titulo' => 'VER TIENDAS',
						'href' => 'http://www.entel.cl/personas/sucursales_tradicionales.iws',
						'icono' => 'img/zonas_content/donde_canjear_icono.png'
					),
					array(
						'titulo' => 'VER TIENDAS EXPRESS',
						'href' => 'http://www.entel.cl/personas/sucursales_express.iws',
						'icono' => 'img/zonas_content/donde_canjear_icono.png'
					),
					array(
						'titulo' => 'MI ENTEL',
						'href' => 'http://www.entel.cl/personas/mi_entel.iws',
						'icono' => 'img/zonas_content/donde_canjear_icono.png'
					),
					array(
						'titulo' => 'OPCIONES AUTOMÁTICAS',
						'href' => 'http://personas.entelpcs.cl/PortalPersonas/appmanager/entelpcs/personas?_nfpb=true&_pageLabel=P8200668131268764639746',
						'icono' => 'img/zonas_content/donde_canjear_icono.png'
					)
				)
			),
			array(
				'key' => 'puntos_que_cliente_soy',
				'titulo' => '¿QUÉ CLIENTE SOY?',
				'texto_descripcion' => '',
				'texto_descripcion_alt' => '',
				'obj_debes_saber' => array(
					'Los clientes de prepago solo podrán realizar canjes a partir de los 30 días de la inscripción.',
					'Los clientes prepago móvil para poder realizar un canje no deberán tener una deuda con el servicio presta luka.',
					'En los canales de IVR 301 o 103 y el sitio web de Entel, los clientes prepago móvil no podrán realizar canjes superiores a los 8.500 Puntos Zona Entel mensuales.',
					'La acumulación de puntos que define la categoría para clientes Suscripción y Cuenta Controlada considera solo la acumulación zona del 1% sobre el RUT del titular, sin considerar la acumulación por categoría, bonos, ni Entel Visa. Se debe considerar que la definición de la etogoría puede demorar hasta el día 10 de cada mes.',
					'El cálculo del porcentaje de acumulación es sobre la boleta de servicios de voz y BAM, incluido roaming o recargas realizadas, esxcluida las cuotas de arriendo del equipo, promociones y/o descuentos.',
					'La acumulación de puntos que define la categoría para clientes Prepago considera solo la acumulación zona del 1% sobre el número móvil, sin considerar la acumulación por categoría, bonos, ni Entel Visa. Se debe considerar que la definción de la categoría puede demorar hasta el día 15 de cada mes.',
					'Para cambios de equipo de un diente Prepago Plus y Zona Prepago se debe considerar un topo de 2 cambios al año calendario por RUT.'
				),
				'obj_contenido' => array(
					array(
						'categoria' => 'SuscripciÓn_',
						'tipos' => array(
							array(
								'titulo' => 'DIAMANTE',
								'imagen' => 'img/zonas_content/clientes_imagen.png',
								'imagen_titulo' => 'img/zonas_content/clientes_imagen_titulo.png',
								'texto_como' => 'Acumulando 7.000 puntos o más, desde el 01/01/2013 hasta el 31/23/2014. Si alcanzas esta categoría, perteneces a ella hasta el 31/12/2014.',
								'texto_cuanto' => 'Acumulas 10 puntos zOna por cada $1.000 de boleta y por ser un Cliente Diamante, obtienes 10 puntos más por cada $1.000 de boleta.',
								'texto_recuerda' => 'Para definir tu categoría de cliente Zona, solo se considera los puntos obtenidos al pagar tu cuenta o realizar recargas. No se considera el puntaje acumulado por otras vías (acumulación por categoría de cliente, bonificaciones, Entel Visa, etc.).',
								'beneficios_1_titulo' => 'Cambio de Equipo',
								'beneficios_1_texto' => 'Realízalo gratis antes del mes 18 en que vence el contrato, si es que tienes 12 de meses de arriendo cumplido sin tener que pagar las cuotas de arriendo pendiente. Esto, a excepción de equipos multimedia, en los que tendrás un descuento de $4.000 por cada cuota pendiente.',
								'beneficios_2_titulo' => 'Descuento en costo de reparación',
								'beneficios_2_texto' => '100% descuento* (1 vez al año).* Excepto para equipos iPhone.',
								'beneficios_3_titulo' => 'Te regalamos',
								'beneficios_3_texto' => '1 SIM de regalo al año calendario luego de bloqueo por pérdida o robo. (No disponible en Tiendas Express).'
							),
							array(
								'titulo' => 'ORO PLUS',
								'imagen' => 'img/zonas_content/clientes_imagen.png',
								'imagen_titulo' => 'img/zonas_content/clientes_imagen_titulo.png',
								'texto_como' => 'Acumulando entre 4.000 y 6.999 puntos desde el 01/01/2013 hasta el 31/12/2013. Si alcanzas esta categoría, permaneces en ella hasta el 31/12/2014.',
								'texto_cuanto' => 'Acumulas 10 puntos zOna por cada $1.000 de boleta y por ser un Cliente Oro Plus, obtienes 5 puntos más por cada $1.000 de boleta (1% facturación más 0.5% por pertenecer a la categoría.',
								'texto_recuerda' => 'Para definir tu categoría de cliente Zona, solo se considera los puntos obtenidos al pagar tu cuenta o realizar recargas. No se considera el puntaje acumulado por otras vías (acumulación por categoría de cliente, bonificaciones, Entel Visa, etc.).',
								'beneficios_1_titulo' => 'Cambio de Equipo',
								'beneficios_1_texto' => 'Realízalo gratis antes del mes 18 en que vence el contrato, si es que tienes 12 de meses de arriendo cumplido sin tener que pagar las cuotas de arriendo pendiente. Esto, a excepción de equipos multimedia, en los que tendrás un descuento de $4.000 por cada cuota pendiente.',
								'beneficios_2_titulo' => 'Descuento en costo de reparación',
								'beneficios_2_texto' => '50% descuento reparación menor y mayor (1 vez al año). Excepto para equipos iPhone.',
								'beneficios_3_titulo' => 'Te regalamos',
								'beneficios_3_texto' => '1 SIM de regalo al año calendario luego de bloqueo por pérdida o robo. (No disponible en Tiendas Express).'
							),
							array(
								'titulo' => 'ORO',
								'imagen' => 'img/zonas_content/clientes_imagen.png',
								'imagen_titulo' => 'img/zonas_content/clientes_imagen_titulo.png',
								'texto_como' => 'Acumulando entre 0 y 3.999 puntos desde el 01/01/2013 hasta el 31/23/2014. Si alcanzas la categoría, perteneces a ella hasta el 31/12/2014.',
								'texto_cuanto' => 'Acumulas 10 puntos zOna por cada $1.000 de boleta.',
								'texto_recuerda' => 'Para definir tu categoría de cliente Zona, solo se considera los puntos obtenidos al pagar tu cuenta o realizar recargas. No se considera el puntaje acumulado por otras vías (acumulación por categoría de cliente, bonificaciones, Entel Visa, etc.).',
								'beneficios_1_titulo' => 'Te regalamos',
								'beneficios_1_texto' => '1 SIM de regalo al año calendario luego de bloqueo por pérdida o robo. (No disponible en Tiendas Express).',
								'beneficios_2_titulo' => '',
								'beneficios_2_texto' => '',
								'beneficios_3_titulo' => '',
								'beneficios_3_texto' => ''
							)
						)
					),
					array(
						'categoria' => 'PrepagO_',
						'tipos' => array(
							array(
								'titulo' => 'PREPAGO PLUS',
								'imagen' => 'img/zonas_content/clientes_imagen.png',
								'imagen_titulo' => 'img/zonas_content/clientes_imagen_titulo.png',
								'texto_como' => 'Teniendo un prepago identificado. Para esto ingresa tu RUT y fecha de nacimiento llamando al 103 o en www.entel.cl. Debes acumular 500 o más puntos por móvil, entre el 01/07/2013 y el 31/12/2013 y así podrás permanecer en la categoría hasta el 30/06/2014.',
								'texto_cuanto' => 'Acumulas 10 puntos zOna por cada $1.000 de boleta.',
								'texto_recuerda' => 'Recuerda que tus puntos serán acumulados desde que estés inscrito en la zOna. Para definir tu categoría de cliente Zona, solo se considera los puntos obtenidos al pagar tu cuenta o realizar recargas. No se considera el puntaje acumulado por otras vías (acumulación por categoría de cliente, bonificaciones, Entel Visa, etc.).',
								'beneficios_1_titulo' => 'Cambio de Equipo',
								'beneficios_1_texto' => 'Renueva tu equipo en grandes tiendas traspasando la carga inicial ($) y las bolsas del nuevo chip a tu antiguo número. Y además recibe 80 min. todo destino, 80 SMS y 80 MB.',
								'beneficios_2_titulo' => 'Descuento en costo de reparación',
								'beneficios_2_texto' => '100% descuento (*) en 1 reparación al año calendario. En caso de daño no reparable, 50% de descuento en cambio de equipo. (*) Excepto para equipos iPhone.',
								'beneficios_3_titulo' => 'Te regalamos',
								'beneficios_3_texto' => '2 cambios de SIM gratis al año calendario (aplica después de pérdida o robo). No disponible en Tiendas Express.'
							),
							array(
								'titulo' => 'PREPAGO',
								'imagen' => 'img/zonas_content/clientes_imagen.png',
								'imagen_titulo' => 'img/zonas_content/clientes_imagen_titulo.png',
								'texto_como' => 'Teniendo un prepago identificado. Para esto ingresa tu RUT y fecha de nacimiento llamando al 103 o en www.entel.cl. Debes acumular entre 0 y 500 puntos por móvil, entre el 01/07/2013 y el 31/12/2013 y así podrás permanecer en la categoría hasta el 30/06/2014.',
								'texto_cuanto' => 'Acumulas 10 puntos zOna por cada $1.000 de recarga.',
								'texto_recuerda' => 'Recuerda que tus puntos serán acumulados desde que estés inscrito en la zOna. Para definir tu categoría de cliente Zona, solo se considera los puntos obtenidos al pagar tu cuenta o realizar recargas. No se considera el puntaje acumulado por otras vías (acumulación por categoría de cliente, bonificaciones, Entel Visa, etc.).',
								'beneficios_1_titulo' => 'Cambio de Equipo',
								'beneficios_1_texto' => 'Renueva tu equipo en grandes tiendas traspasando la carga inicial ($) y las bolsas del nuevo chip a tu antiguo número. Y además recibe 40 min. todo destino, 40 SMS y 40 MB.',
								'beneficios_2_titulo' => 'Descuento en costo de reparación',
								'beneficios_2_texto' => 'Solo en caso de daño no reparable, 20% de descuento (*) en cambio de equipo. (*) Excepto para equipos iPhone.',
								'beneficios_3_titulo' => 'Te regalamos',
								'beneficios_3_texto' => '1 cambio de SIM gratis al año calendario (aplica después de pérdida o robo). No disponible en Tiendas Express.'
							)
						)
					)
				)
			)
		);

		foreach ($pages as $page)
		{
			$page['obj_debes_saber'] = json_encode($page['obj_debes_saber']);
			$page['obj_contenido'] = json_encode($page['obj_contenido']);
			$new_page = new Page($page);
			$new_page->save();
		}
	}
} 