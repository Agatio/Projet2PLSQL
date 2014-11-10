<?php

require_once 'models/baseManager.php';
require_once 'models/database.php';

class DatabaseManager extends BaseManager
{
    public function __construct($db) {
        parent::__construct($db);
    }
  
    public function get($id)
    {
        $id = (int) $id;
        $datab = oci_parse($this->_db, 'SELECT * FROM databases WHERE DB_ID = :dbid');
        oci_bind_by_name($datab, ':dbid', $id);
        oci_execute($datab);

        while(($row = oci_fetch_row($datab)) != false)
        {
            return new Database($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
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
            array_push($databases, new Database($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]));
        }
        return $databases;
    }

}

?>