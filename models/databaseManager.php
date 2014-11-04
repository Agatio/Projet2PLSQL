<?php

require_once 'models/baseManager.php';
require_once 'models/database.php';

class DatabaseManager extends BaseManager
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
        /*$q = $this->_db->prepare('SELECT id, liaison, train, heureDepart FROM trajets WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Trajet($data);*/

        $datab = oci_parse($this->_db, 'SELECT * FROM databases WHERE DB_ID = :dbid');
        oci_bind_by_name($datab, ':dbid', $id);
        oci_execute($datab);
        while(($row = oci_fetch_row($datab)) != false)
        {
            return new Database($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
        }
    }
    
    public function getList()
    {
        $databases = array();
        $datab = oci_parse($this->_db, 'SELECT * FROM databases WHERE USER_ID = :userid');
        oci_bind_by_name($datab, ':userid', $_SESSION['user_id']);
        oci_execute($datab);
        while(($row = oci_fetch_row($datab)) != false)
        {
            array_push($databases, new Database($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
        }
        return $databases;
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