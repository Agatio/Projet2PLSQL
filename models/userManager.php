<?php

require_once 'models/baseManager.php';
require_once 'models/user.php';

class UserManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add(User $u) {
        $q = $this->_db->prepare('INSERT INTO users SET username = :l, passwd=:pw');
        $q->bindValue(':l', $u->login(), PDO::PARAM_STR);
        $q->bindValue(':pw', $u->password(), PDO::PARAM_STR);
        $q->execute();

        $u->hydrate(array(
            'id' => $this->_db->lastInsertId(),
        ));
    }

    public function delete(User $u)
    {
        $q = $this->_db->prepare('DELETE FROM users WHERE user_id = :id');
        $q->bindValue(':id', $u->id());
        $q->execute();
    }

    public function exists($info)
    {
        if (is_string($info))
        {
            $stid = oci_parse($this->_db, 'SELECT COUNT(*) FROM users WHERE username = :l');
            oci_bind_by_name($stid, ':l', $info);
            oci_execute($stid);
            return (bool) oci_fetch($stid);

            //$q = $this->_db->prepare('SELECT COUNT(*) FROM users WHERE username = :l');
            //$q->bindValue(':l', $info, PDO::PARAM_STR);
            //$q->execute();
            //return (bool) $q->fetchColumn();
        }
        else
        {
            $id = (int) $info;
            $q = $this->_db->prepare('SELECT COUNT(*) FROM users WHERE user_id = :id');
            $q->bindValue(':id', $id, PDO::PARAM_INT);
            $q->execute();
            return (bool) $q->fetchColumn();
        }
    }

    public function get($info)
    {
        if (is_string($info)) {
            $q = $this->_db->prepare('SELECT user_id, username, passws FROM users WHERE username = :l');
            $q->bindValue(':l', $info, PDO::PARAM_STR);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return new User($data);
        } else {
            $id = (int) $info;
            $q = $this->_db->prepare('SELECT user_id, username, passwd FROM users WHERE user_id = :id');
            $q->bindValue(':id', $id, PDO::PARAM_INT);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return new User($data);
        }
    }
    
    public function getList()
    {
        $users = array();
        $q = $this->_db->query('SELECT user_id, username, passwd FROM users');
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }
        return $users;
    }
    
    public function update(User $u)
    {
        $q = $this->_db->prepare('UPDATE users SET username = :l, passwd = :pw WHERE user_id = :id');
        $q->bindValue(':l', $u->login(), PDO::PARAM_STR);
        $q->bindValue(':pw', $u->password(), PDO::PARAM_STR);
        $q->bindValue(':id', $v->id(), PDO::PARAM_INT);
        $q->execute();
    }
}

?>