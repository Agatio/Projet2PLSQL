<?php

class BaseModel
{
	public function __construct(array $data) {
		$this->hydrate($data);
	}

	public function hydrate(array $data) {
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst(strtolower($key));
			if(method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
}

?>