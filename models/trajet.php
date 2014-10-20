<?php

require_once 'models/baseModel.php';

class Trajet extends BaseModel
{
	private $_id;
    private $_liaison;
    private $_train;
    private $_heureDepart;

    public function __construct(array $data) {
        parent::__construct($data);
    }

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}

    public function setLiaison($l) {
		$l = (int) $l;
		if ($l > 0) {
			$this->_liaison = $l;
		}
    }

    public function setTrain($t) {
		$t = (int) $t;
		if ($t > 0) {
			$this->_train = $t;
		}
    }

    public function setHeureDepart($h) {
    	if (is_string($h)) {
    		$this->_heureDepart = $h;	
    	}
    }

    public function id() {
    	return $this->_id;
    }

    public function liaison() {
        return $this->_liaison;
    }

    public function train() {
        return $this->_train;
    }

    public function heureDepart() {
        return $this->_heureDepart;
    }
}

?>