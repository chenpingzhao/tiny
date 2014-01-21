<?php
class Request 
{
	protected $_app;
	protected $_rawBody;
	protected $_get;
	protected $_post;
	protected $_cookie;
	protected $_server;
	protected $_file;
	protected $_baseUrl;

	public function __construct($app) {
		$this->_app = $app;
		$this->createFromGlobal();
	}

	public function createFromGlobal() {
		$this->_cookie 	= $this->stripSlashes($_COOKIE);
		$this->_server 	= $this->stripSlashes($_SERVER);
		$this->_file 	= $this->stripSlashes($_FILE);
		if ($this->IsPut() || $this->isDelete()) {
			$this->_rawBody = $this->stripcslashes($this->getRawBody());
		} else {
			$this->_get 	= $this->stripSlashes($_GET);
			$this->_post 	= $this->stripSlashes($_POST);
		}
	}

	public function getParam($key, $default = null) {
		if (isset($this->_get[$key])) return $this->_get[$key];
		if (isset($this->_post[$key])) return $this->_post[$key];
		return $default;
	}

	public function getParams() {
		return $this->stripSlashes($_REQUEST);
	}

	public function isPost() {

	}

    public function IsPut()
    {
        return (isset($this->_server['REQUEST_METHOD']) && !strcasecmp($this->_server['REQUEST_METHOD'],'PUT'));
    }

    public function isDelete()
    {
        return (isset($this->_server['REQUEST_METHOD']) && !strcasecmp($this->_server['REQUEST_METHOD'],'DELETE'));
    }
	public function isAjax() {

	}


   public function getRawBody()
    {
        static $rawBody;
        if($rawBody===null)
            $rawBody=file_get_contents('php://input');
        return $rawBody;
    }


    public function stripSlashes(&$data)
    {    
        if(is_array($data))
        {    
            if(count($data) == 0)
                return $data;
            $keys=array_map('stripslashes',array_keys($data));
            $data=array_combine($keys,array_values($data));
            return array_map(array($this,'stripSlashes'),$data);
        }    
        else 
            return stripslashes($data);
    } 	
}