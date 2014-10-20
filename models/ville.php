<?php

require_once 'models/baseModel.php';

class Ville extends BaseModel
{
	private $_id;
    private $_nom;
    private $_lat;
    private $_lng;

    public function __construct(array $data) {
    	parent::__construct($data);
	}

	public function setId($id) {
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}

    public function setNom($n) {
        if(is_string($n)) {
            $this->_nom = $n;
        }
    }

    public function setLat($lat) {
        $lat = (float) $lat;
        $this->_lat = $lat;
    }

    public function setLng($lng) {
        $lng = (float) $lng;
        $this->_lng = $lng;
    }

    public function id() {
    	return $this->_id;
    }

    public function nom() {
        return $this->_nom;
    }

    public function lat() {
        return $this->_lat;
    }

    public function lng() {
        return $this->_lng;
    }
}

?>