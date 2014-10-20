<?php

require_once 'models/baseManager.php';
require_once 'models/train.php';

class TrainManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add(Train $t) {
        $q = $this->_db->prepare('INSERT INTO trains SET nbPlaces = :nb, vitesse = :v');
        $q->bindValue(':nb', $t->nbPlaces(), PDO::PARAM_INT);
        $q->bindValue(':v', $t->vitesse(), PDO::PARAM_INT);
        $q->execute();

        $t->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(Train $t)
    {
        $q = $this->_db->prepare('DELETE FROM trains WHERE id = :id');
        $q->bindValue(':id', $t->id());
        $q->execute();
    }

    public function exists($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT COUNT(*) FROM trains WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT id, nbPlaces, vitesse FROM trains WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Train($data);
    }
    
    public function getList()
    {
        $trains = array();
        $q = $this->_db->query('SELECT id, nbPlaces, vitesse FROM trains');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $trains[] = new Train($data);
        }
        return $trains;
    }
    
    public function update(Train $t)
    {
        $q = $this->_db->prepare('UPDATE trains SET nbPlaces = :nb, vitesse = :v WHERE id = :id');
        $q->bindValue(':nb', $t->nbPlaces(), PDO::PARAM_INT);
        $q->bindValue(':v', $t->vitesse(), PDO::PARAM_INT);
        $q->bindValue(':id', $t->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>