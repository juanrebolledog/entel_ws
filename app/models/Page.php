<?php

class Page extends BaseModel {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'pages';

	public $timestamps = false;
	
	static public function getAll()
	{
		$pages = self::all();
		$pages->each(function($page)
		{
			$page->obj_debes_saber = json_decode($page->obj_debes_saber, true);
			$decoded = json_decode($page->obj_contenido, true);
			$page->obj_contenido = $page->prepareForWS($decoded);
		});
		return $pages;
	}

	public function prepareForWS($array)
	{
		$ifields = array('icono', 'imagen', 'imagen_titulo');
		foreach ($array as $super_key => $super_value)
		{
			foreach ($super_value as $key => $value)
			{
				if (!is_numeric($key) && in_array($key, $ifields))
				{
					try
					{
						$array[$super_key][$key] = asset($array[$super_key][$key]);
					}
					catch (ErrorException $e)
					{
						var_dump($e->getMessage());
					}
				}

				if (is_array($value))
				{
					foreach ($value as $sub_key => $sub_value)
					{

						if (!is_numeric($sub_key) && in_array($sub_key, $ifields))
						{
							try
							{
								$array[$super_key][$key][$sub_key] = asset($array[$super_key][$key][$sub_key]);
							}
							catch (ErrorException $e)
							{
								var_dump($e->getMessage());
							}
						}

						if (is_array($sub_value))
						{
							foreach ($sub_value as $ssub_key => $ssub_value)
							{
								if (!is_numeric($ssub_key) && in_array($ssub_key, $ifields))
								{
									try
									{
										$array[$super_key][$key][$sub_key][$ssub_key] = asset($array[$super_key][$key][$sub_key][$ssub_key]);
									}
									catch (ErrorException $e)
									{
										var_dump($e->getMessage());
									}
								}
							}
						}
					}
				}
			}
		}

		return $array;
	}
}
