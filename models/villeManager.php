<?php

require_once 'models/baseManager.php';
require_once 'models/ville.php';

class VilleManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add(Ville $v) {
        $q = $this->_db->prepare('INSERT INTO villes SET nom = :nom, lat = :lat, lng = :lng');
        $q->bindValue(':nom', $v->nom(), PDO::PARAM_STR);
        $q->bindValue(':lat', $v->lat(), PDO::PARAM_INT);
        $q->bindValue(':lng', $v->lng(), PDO::PARAM_INT);
        $q->execute();

        $v->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(Ville $v)
    {
        $q = $this->_db->prepare('DELETE FROM villes WHERE id = :id');
        $q->bindValue(':id', $v->id());
        $q->execute();
    }

    public function exists($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT COUNT(*) FROM villes WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        return (bool) $q->fetchColumn();
    }

    public function exists_nom($nom)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM villes WHERE nom = :nom');
        $q->bindValue(':nom', $nom, PDO::PARAM_STR);
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT * FROM villes WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Ville($data);
    }
    
    public function getList()
    {
        $villes = array();
        $q = $this->_db->query('SELECT * FROM villes');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $villes[] = new Ville($data);
        }
        return $villes;
    }
    
    public function update(Ville $v)
    {
        $q = $this->_db->prepare('UPDATE villes SET nom = :nom, lat = :lat, lng = :lng WHERE id = :id');
        $q->bindValue(':nom', $v->nom(), PDO::PARAM_STR);
        $q->bindValue(':lat', $v->lat(), PDO::PARAM_INT);
        $q->bindValue(':lng', $v->lng(), PDO::PARAM_INT);
        $q->bindValue(':id', $v->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>