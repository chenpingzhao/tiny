<?php
class Router
{
	protected $_app;
	protected $_match;
	public function __construct($app) {
		$this->_app = $app;
	}

	public function route() {
		$module 	= $this->_app->getRequest()->getParam('m');
		$controller = $this->_app->getRequest()->getParam('c');
		$action 	= $this->_app->getRequest()->getParam('a');
		$this->_match = array($module, $controller, $action);
		return $this;
	}

	public function getMatch() {
		return $this->_match;
	}


}