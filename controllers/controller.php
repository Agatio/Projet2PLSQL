<?php

class Controller
{
	protected $db;

    public function __construct() {
    	//$this->db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    	//$this->db = oci_pconnect(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    	//$this->db = ocilogon(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    	//$this->db = ora_logon(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
/*$this->db = oci_connect(
  SQL_USERNAME,
  SQL_PASSWORD,
  "(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(Host = grive.iutrs.unistra.fr)(Port = 1521))
    )
  (CONNECT_DATA =
    (SERVICE_NAME = PROJET2)
  )
)");*/

$desc = "(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(Host = grive.iutrs.unistra.fr)(Port = 1521))
    )
  (CONNECT_DATA =
    (SERVER = DEDICATED)
    (SERVICE_NAME = PROJET2.ustrasbg.fr)
    (SID = PROJET2)
  )
)";

$this->db = oci_connect(SQL_USERNAME, SQL_PASSWORD, $desc);

/*$this->db = ora_logon("user@TNSNAME", SQL_PASSWORD;*/
}
}

?>