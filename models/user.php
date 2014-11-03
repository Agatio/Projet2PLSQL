<?php

require_once 'models/baseModel.php';

class User extends BaseModel
{
	private $_user_id;
    private $_username;
    private $_passwd;

    /*public function __construct(array $data) {
        parent::__construct($data);
    }*/
	
	public function __construct($uid, $uname, $upass) {
		$this->_user_id = $uid;
		$this->_username = $uname;
		$this->_passwd = $upass;
    }

	public function setUser_id($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_user_id = $id;
		}
	}

    public function setUsername($l) {
        if(is_string($l)) {
            $this->_username = $l;
        }
    }

    public function setPasswd($p) {
        if(is_string($p)) {
            $this->_passwd = $p;
        }
    }

    public function user_id() {
    	return $this->_user_id;
    }

    public function username() {
        return $this->_username;
    }

    public function passwd() {
        return $this->_passwd;
    }
}

?>