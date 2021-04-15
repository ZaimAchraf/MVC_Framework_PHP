<?php 
namespace PHPMVC\Lib;
/**
 * 
 */
class Autoload
{
	
	public static function autoload($class)
	{
		$className = str_replace('PHPMVC', '', $class);
		$className = str_replace('\\', DS, $className);
		$className =  APP_PATH . strtolower($className) . '.php';
		
		if (file_exists($className)) {
			require $className;
		}
		
	}
}
spl_autoload_register(__namespace__ . '\Autoload::autoload');
 ?>