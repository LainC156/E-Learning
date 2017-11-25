<?php
class Sistema
{
	const 
	  HTML = 1,
	  JSON = 2;

	static private 
	  $aplicacion;

	public static function init()
	{
		self::$aplicacion =  !empty($_SERVER['CONTENT_TYPE'])
							 && $_SERVER['CONTENT_TYPE']==='application/json'
							 && $_SERVER['HTTP_ACCEPT'] ==='text/json'
							? self::JSON : 0;
		
		self::$aplicacion = (boolean) preg_match('/html/', $_SERVER['HTTP_ACCEPT'])
                            ? self::HTML : self::$aplicacion;
	}


	public static function aplicacion($tipo = '')
	{
		if ($tipo==='') {
			return self::$aplicacion;
		}
		
		return self::$aplicacion===$tipo;
	}

}