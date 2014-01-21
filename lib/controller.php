<?php
class Controller
{
	protected $_request;
	protected $_response;
	public function __construct(Request $request, Response $response) {
		$this->_request 	= $request;
		$this->_response 	= $response;
		$this->_view 		= new View(VIEW_PATH);
	}


	public function dispatch($action) {
		$this->$action();
	}

	public function render($script) {
       $this->_response->setContent($this->_view->render($script));		
	}

}