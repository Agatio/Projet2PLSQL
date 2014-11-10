<?php

require_once 'models/baseModel.php';

class Database extends BaseModel
{
	private $_db_id;
    private $_db_name;
    private $_db_domain;
    private $_host;
    private $_port;
    private $_user_id;
	private $_sgbd;
	private $_sid;

    /*public function __construct(array $data) {
        parent::__construct($data);
    }*/

    public function __construct($db_id,$db_name,$db_domain,$host,$port,$user_id,$sgbd,$sid) {
        $this->_db_id = $db_id;
        $this->_db_name = $db_name;
        $this->_db_domain = $db_domain;
        $this->_host = $host;
        $this->_port = $port;
        $this->_user_id = $user_id;
		$this->_sgbd = $sgbd;
		$this->_sid = $sid;
    }

	public function setDb_id($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_db_id = $id;
		}
	}

    public function setDb_name($dbname) {
			$this->_db_name = $dbname;
    }

    public function setDb_domain($dbdomain) {
			$this->_db_domain = $dbdomain;
    }

    public function setHost($host) {
    		$this->_host = $host;	
    }

    public function setPort($port) {
            $this->_port = $port;   
    }

    public function setUser_id($userid) {
            $this->_user_id = $userid;   
    }
	
	public function setSgbd($sgbd) {
            $this->_sgbd = $sgbd;   
    }
	
	public function setSid($sid) {
            $this->_sid = $sid;   
    }

    public function db_id() {
    	return $this->_db_id;
    }

    public function db_name() {
        return $this->_db_name;
    }

    public function db_domain() {
        return $this->_db_domain;
    }

    public function host() {
        return $this->_host;
    }

    public function port() {
        return $this->_port;
    }

    public function user_id() {
        return $this->_user_id;
    }
	
	public function sgbd() {
        return $this->_sgbd;
    }
	
	public function sid() {
        return $this->_sid;
    }
}

?>