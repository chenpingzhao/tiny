<?php
class Response 
{
	protected $_app;
	protected $_content;
	public function __construct($app) {
		$this->app = $app;
	}

	public function setContent($content) {
		$this->_content = $content;
	}

	public function sendResponse() {
		echo $this->_content;
	}
} 