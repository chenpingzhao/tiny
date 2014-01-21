<?php
require __DIR__ . "/request.php";
require __DIR__ . "/response.php";
require __DIR__ . "/router.php";
require __DIR__ . "/dispatch.php";
require __DIR__ . "/view.php";

class App 
{
	protected $_request;
	protected $_response;
	protected $_dispatch;
	protected $_router;
	protected $_config;
	
	public function __construct($config) {
		if (is_array($config)) {
			$this->config = $config;
		}
	}


	public function bootstrap() {
		$this->_request 	= new Request($this);
		$this->_response 	= new Response($this);
		$this->_router 		= new Router($this);
		$this->_dispatch 	= new Dispatch($this);
		return $this;
	}

	public function run() {
		$this->_router->route();
		$this->_dispatch->dispatch();
		$this->_response->sendResponse();
	}

	public function getRequest() {
		return $this->_request;
	}

	public function getResponse() {
		return $this->_response;
	}

	public function getRouter() {
		return $this->_router;
	}

	public function getDispatch() {
		return $this->_dispatch;
	}
}