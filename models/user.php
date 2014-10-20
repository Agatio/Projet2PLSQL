<?php

require_once 'models/baseModel.php';

class User extends BaseModel
{
	private $_user_id;
    private $_username;
    private $_passwd;

    public function __construct(array $data) {
        parent::__construct($data);
    }

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_user_id = $id;
		}
	}

    public function setLogin($l) {
        if(is_string($l)) {
            $this->_username = $l;
        }
    }

    public function setPassword($p) {
        if(is_string($p)) {
            $this->_passwd = $p;
        }
    }

    public function id() {
    	return $this->_user_id;
    }

    public function login() {
        return $this->_username;
    }

    public function password() {
        return $this->_passwd;
    }
}

?>