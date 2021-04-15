<?php 
namespace PHPMVC\Controllers;
use PHPMVC\Lib\FrontController;
/**
 * 
 */
class AbstractController
{
	public $controller;
	public $action;
	public $params;

	private $data = array();
	
	public function __construct($cont, $act, $pars)
	{
		$this->controller = $cont;
		$this->action = $act;
		$this->params = $pars;
	}

	public function notfoundAction()
	{
		$this->view();
	}

	public function view()
	{
		if ($this->action === FrontController::NOT_FOUND_ACTION) 
		{
			require_once VIEWS_PATH . DS . 'notfound' . DS . 'notfound.view.php';

		}else{

			$view = VIEWS_PATH . DS . $this->controller . DS . $this->action . '.view.php';

			if (file_exists($view)) 
			{
				require_once $view;
			}else{
				require_once VIEWS_PATH . DS . 'notfound' . DS . 'noview.view.php';
			}
		}
	}

	public function getData(){
	    return $this->data;
    }

    public function setData(array $data){
        $this->data = $data;
    }
}