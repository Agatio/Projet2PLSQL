<?php

require_once 'models/baseModel.php';

class Liaison extends BaseModel
{
	private $_id;
    private $_villeDepart;
    private $_villeArrivee;
    private $_longueur;

    public function __construct(array $data) {
        parent::__construct($data);
    }

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}

    public function setVilleDepart($v) {
        $v = (int) $v;
        if ($v > 0) {
            $this->_villeDepart = $v;
        }
    }

    public function setVilleArrivee($v) {
        $v = (int) $v;
        if ($v > 0) {
            $this->_villeArrivee = $v;
        }
    }

    public function setLongueur($l) {
        $l = (int) $l;
        if ($l >= 0) {
            $this->_longueur = $l;
        }
    }

    public function id() {
    	return $this->_id;
    }

    public function villeDepart() {
        return $this->_villeDepart;
    }

    public function villeArrivee() {
        return $this->_villeArrivee;
    }

    public function longueur() {
        return $this->_longueur;
    }
}

?>