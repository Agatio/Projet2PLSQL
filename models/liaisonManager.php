<?php

require_once 'models/baseManager.php';
require_once 'models/liaison.php';

class LiaisonManager extends BaseManager
{
    public function __construct($db) {
    	parent::__construct($db);
	}

    public function add(Liaison $l) {
        $q = $this->_db->prepare('INSERT INTO liaisons SET villeDepart = :vd, villeArrivee = :va, longueur = :long');
        $q->bindValue(':vd', $l->villeDepart(), PDO::PARAM_INT);
        $q->bindValue(':va', $l->villeArrivee(), PDO::PARAM_INT);
        $q->bindValue(':long', $l->longueur(), PDO::PARAM_INT);
        $q->execute();

        $l->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(Liaison $l)
    {
        $q = $this->_db->prepare('DELETE FROM liaisons WHERE id = :id');
        $q->bindValue(':id', $l->id());
        $q->execute();
    }

    public function exists($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT COUNT(*) FROM liaisons WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT id, villeDepart, villeArrivee, longueur FROM liaisons WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Liaison($data);
    }
    
    public function getList()
    {
        $liaisons = array();
        $q = $this->_db->query('SELECT id, villeDepart, villeArrivee, longueur FROM liaisons');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $liaisons[] = new Liaison($data);
        }
        return $liaisons;
    }

    public function update(Liaison $l)
    {
        $q = $this->_db->prepare('UPDATE liaisons SET villeDepart = :vd, villeArrivee = :va, longueur = :long WHERE id = :id');
        $q->bindValue(':vd', $l->villeDepart(), PDO::PARAM_INT);
        $q->bindValue(':va', $l->villeArrivee(), PDO::PARAM_INT);
        $q->bindValue(':long', $l->longueur(), PDO::PARAM_INT);
        $q->bindValue(':id', $l->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>