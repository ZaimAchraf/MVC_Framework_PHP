<?php 
namespace PHPMVC\Lib;
use PHPMVC\Controllers\NotFoundController;
use PHPMVC\Controllers\IndexController;
/**
 * 
 */
class FrontController
{
	const NOT_FOUND_CONTROLLER = 'PHPMVC\Controllers\NotFoundController';
	const NOT_FOUND_ACTION = 'notfound';
	const NOT_FOUND_METHOD = 'notfoundmethod';
	public $controller = 'index';
	public $action = 'default';
	public $params = array();

	public function __construct(){
		$this->parseUrl();
	}

	protected function parseUrl()
	{
		$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$url = trim($url, '/');
		$url = explode('/', $url,3);
		if ($url[0] != '') {
			$this->controller = $url[0];
			if (isset($url[1]) && $url[1] != '') {
				$this->action = $url[1];
				if (isset($url[2]) && $url[2] != '') {
					$this->params = explode('/', $url[2]);
				}
			}
		}
	}

	public function dispatch(){
		$controllerClassName = ucfirst($this->controller) . 'Controller';
		$controllerClassName = 'PHPMVC\Controllers\\' . $controllerClassName;

		if (!class_exists($controllerClassName)) {
			$this->controller = 'notfound';
			$controllerClassName = self::NOT_FOUND_CONTROLLER;
		}
		
		$controller = new $controllerClassName($this->controller, $this->action, $this->params);
		$actionName = $controller->action . 'Action';

		if (!method_exists($controller, $actionName)) {
			$actionName = self::NOT_FOUND_ACTION . 'Action';
			$controller->action = self::NOT_FOUND_ACTION;
		}
		$controller->$actionName();
	}
}
 ?>