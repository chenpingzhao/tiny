<?php
class View
{
	private $_basePath;

	public function __construct($path) {
		$this->_basePath = rtrim($path, "/");
	}

	public function render($file) {
		ob_start();
		include $this->_basePath . "/" . $file;
		return ob_get_clean();
	}

	public function assign($key, $value) {
		$this->$key = $value;
	}	

	public function assignArray($data) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}
}