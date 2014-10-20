<?php

require_once 'models/baseModel.php';

class Reservation extends BaseModel
{
	private $_id;
    private $_user;
    private $_trajet;

    public function __construct(array $data) {
    	parent::__construct($data);
	}

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}

    public function setUser($u) {
		$u = (int) $u;
		if ($u > 0) {
			$this->_user = $u;
		}
    }

    public function setTrajet($t) {
		$t = (int) $t;
		if ($t > 0) {
			$this->_trajet = $t;
		}
    }

    public function id() {
    	return $this->_id;
    }

    public function user() {
        return $this->_user;
    }

    public function trajet() {
        return $this->_trajet;
    }
}

?>