<?php
require LIB_PATH . "/controller.php";
class HomeController extends Controller
{
	public function welcomeAction() {
		$params = $this->_request->getParams();
		unset($params['m'], $params['c'], $params['a']);
		$this->_view->assignArray($params);
		$this->render('home/welcome.phtml');
	}
}