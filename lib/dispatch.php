<?php
class Dispatch
{
	protected $_app;
	protected $_appPath;

	public function __construct($app) {
		$this->_app = $app;
		$this->getAppPath();
	}
	public function dispatch() {
		list($module, $controller, $action) = $this->_app->getRouter()->getMatch();
		$controller = ucfirst($controller) . "Controller";
		$path = is_null($module) ? "" : strtolower($module) . "/";

		$path .= 'controller/' . $controller . ".php";
		$absolutePath = rtrim($this->_appPath) . "/app/" . $path;
		if (!file_exists($absolutePath)) {
			throw new Exception("the $controller not found", 1);
		}
		include $absolutePath;
		$instance = new $controller($this->_app->getRequest(), $this->_app->getResponse());		
		$instance->dispatch($action . "Action");
		return $this;
	}

	public function getAppPath() {
		if (defined('APP_PATH')) {
			$this->_appPath = APP_PATH;
		} elseif (isset($this->_app->config['appPath'])) {
			$this->_appPath = $this->_app->config['appPath'];
		} else {
			$this->_appPath = dirname(__DIR__);
		}
	}


}