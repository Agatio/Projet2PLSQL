<?php

require_once 'models/baseManager.php';
require_once 'models/reservation.php';

class ReservationManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add(Reservation $r) {
        $q = $this->_db->prepare('INSERT INTO reservations SET user = :u, trajet = :t');
        $q->bindValue(':u', $r->user(), PDO::PARAM_INT);
        $q->bindValue(':t', $r->trajet(), PDO::PARAM_INT);
        $q->execute();

        $r->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(Reservation $r)
    {
        $q = $this->_db->prepare('DELETE FROM reservations WHERE id = :id');
        $q->bindValue(':id', $r->id());
        $q->execute();
    }

    public function exists($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT COUNT(*) FROM reservations WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        return (bool) $q->fetchColumn();
    }
    
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->prepare('SELECT id, user, trajet FROM reservations WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return new Reservation($data);
    }
    
    public function getList($user)
    {
        $user = (int) $user;
        $resas = array();
        $q = $this->_db->prepare('SELECT id, user, trajet FROM reservations WHERE user=:u');
        $q->bindValue(':u', $user, PDO::PARAM_INT);
        $q->execute();
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $resas[] = new Reservation($data);
        }
        return $resas;
    }
    
    public function update(Reservation $r)
    {
        $q = $this->_db->prepare('UPDATE reservations SET user = :u, trajet = :t WHERE id = :id');
        $q->bindValue(':u', $r->user(), PDO::PARAM_INT);
        $q->bindValue(':t', $r->trajet(), PDO::PARAM_INT);
        $q->bindValue(':id', $t->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>