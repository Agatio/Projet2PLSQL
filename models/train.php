<?php

require_once 'models/baseModel.php';

class Train extends BaseModel
{
	private $_id;
    private $_nbPlaces;
    private $_vitesse;

    public function __construct(array $data) {
    	parent::__construct($data);
	}

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}

    public function setNbPlaces($nb) {
		$nb = (int) $nb;
		if ($nb > 0) {
			$this->_nbPlaces = $nb;
		}
    }

    public function setVitesse($v) {
		$v = (int) $v;
		if ($v > 0) {
			$this->_vitesse = $v;
		}
    }

    public function id() {
    	return $this->_id;
    }

    public function nbPlaces() {
    	return $this->_nbPlaces;
    }

    public function vitesse() {
    	return $this->_vitesse;
    }
}

?>