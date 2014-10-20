<?php

require_once 'models/baseManager.php';
require_once 'models/trajet.php';

class TrajetManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add(Trajet $t) {
        $q = $this->_db->prepare('INSERT INTO trajets SET liaison = :l, train = :t, heureDepart = :h');
        $q->bindValue(':l', $t->liaison(), PDO::PARAM_INT);
        $q->bindValue(':t', $t->train(), PDO::PARAM_INT);
        $q->bindValue(':h', $t->heureDepart(), PDO::PARAM_STR);
        $q->execute();

        $t->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(Trajet $t)
    {
        $q = $this->_db->prepare('DELETE FROM trajets WHERE id = :id');
        $q->bindValue(':id', $t->id());
        $q->execute();
    }

    public function exists($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT COUNT(*) FROM trajets WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT id, liaison, train, heureDepart FROM trajets WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Trajet($data);
    }
    
    public function getList()
    {
        $trajets = array();
        $q = $this->_db->query('SELECT id, liaison, train, heureDepart FROM trajets');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $trajets[] = new Trajet($data);
        }
        return $trajets;
    }
    
    public function update(Trajet $t)
    {
        $q = $this->_db->prepare('UPDATE trajets SET liaison = :l, train = :t, heureDepart = :h WHERE id = :id');
        $q->bindValue(':l', $t->liaison(), PDO::PARAM_INT);
        $q->bindValue(':t', $t->train(), PDO::PARAM_INT);
        $q->bindValue(':h', $t->heureDepart(), PDO::PARAM_STR);
        $q->bindValue(':id', $t->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>