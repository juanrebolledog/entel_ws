<?php
use Mockery as m;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class BenefitTest extends TestCase {
	public function setUp()
	{
		parent::setUp();
	}

	public function testCreate()
	{
		foreach (range(0, 5) as $k)
		{
			$filename = '/tmp/imagen' . $k . '.png';
			if (copy(public_path() . '/img/benefits/default/grande.png', $filename))
			{
				$files[$k] = new Symfony\Component\HttpFoundation\File\UploadedFile($filename, 'imagen.png', 'image/png', filesize($filename), null, true);
			}
		}
		$benefit_array = array(
			'nombre' => 'Prueba',
			'descripcion' => 'Prueba',
			'legal' => 'Prueba',
			'sub_categoria_id' => 1,
			'fecha' => 'Diciembre 2014',
			'tags' => 'prueba, prueba',
			'sms_texto' => 'HOLA',
			'sms_nro' => '1234',
			'icono' => $files[0],
			'imagen_grande' => $files[1],
			'imagen_grande_web' => $files[2],
			'imagen_chica' => $files[3],
			'imagen_titulo' => $files[4],
			'imagen_descripcion' => $files[5],
			'lat' => array(
				-33.41
			),
			'lng' => array(
				-70.60
			),
			'lugar' => array(
				'Metropolitano'
			)
		);
		$benefit = Benefit::createBenefit($benefit_array);
		$benefit_db = Benefit::with('locations', 'sub_category')->find($benefit->id);
		$this->assertEquals(1, count($benefit_db->locations));
	}

	public function testCreateSomeEmptyLocations()
	{
		foreach (range(0, 5) as $k)
		{
			$filename = '/tmp/imagen' . $k . '.png';
			if (copy(public_path() . '/img/benefits/default/grande.png', $filename))
			{
				$files[$k] = new Symfony\Component\HttpFoundation\File\UploadedFile($filename, 'imagen.png', 'image/png', filesize($filename), null, true);
			}
		}
		$benefit_array = array(
			'nombre' => 'Prueba',
			'descripcion' => 'Prueba',
			'legal' => 'Prueba',
			'sub_categoria_id' => 1,
			'fecha' => 'Diciembre 2014',
			'tags' => 'prueba, prueba',
			'sms_texto' => 'HOLA',
			'sms_nro' => '1234',
			'icono' => $files[0],
			'imagen_grande' => $files[1],
			'imagen_grande_web' => $files[2],
			'imagen_chica' => $files[3],
			'imagen_titulo' => $files[4],
			'imagen_descripcion' => $files[5],
			'lat' => array(
				-33.41,
				''
			),
			'lng' => array(
				-70.60,
				''
			),
			'lugar' => array(
				'Metropolitano',
				''
			)
		);
		$benefit = Benefit::createBenefit($benefit_array);
		$benefit_db = Benefit::with('locations', 'sub_category')->find($benefit->id);
		$this->assertEquals(1, count($benefit_db->locations));
	}
}