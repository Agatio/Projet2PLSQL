<?php

require_once 'controllers/controller.php';

require_once 'models/databaseManager.php';

class Controller_Database extends Controller
{
	private $databm;

	public function __construct()
	{
		parent::__construct();
		$this->databm = new DatabaseManager($this->db);
	}

	public function edit()
	{
		$trajets = $this->trajm->getList();
		$trains = $this->trainm->getList();
		$liaisons = $this->lm->getList();
		include 'views/editTrajets.php';
	}

	public function databaselist()
	{
		$databases = $this->databm->getList();
		include 'views/listDatabases.php';
	}

	public function show()
	{
		$database = $this->databm->get($_GET['dbid']);
		
		$desc = "(DESCRIPTION =
	    (ADDRESS_LIST =
	      (ADDRESS = (PROTOCOL = TCP)(Host = ".$database->host().")(Port = ".$database->port()."))
	    )
		  (CONNECT_DATA =
		    (SERVER = DEDICATED)
		    (SID = ".$_POST['SID'].")
		  )
		)";

		$newDB = oci_connect($_POST['login'], $_POST['password'], $desc);
		$_SESSION['logDB'] = $_POST['login'];
		$_SESSION['logPw'] = $_POST['password'];
		$_SESSION['desc'] = $desc;

		$tables = array();
        //$data = oci_parse($newDB, 'SELECT ALL_ALL_TABLES FROM dict');
		//$data = oci_parse($newDB, 'SELECT TABLE_NAME from ALL_ALL_TABLES');
		$data = oci_parse($newDB, 'SELECT OBJECT_NAME, OBJECT_TYPE from ALL_OBJECTS ORDER BY OBJECT_TYPE');
        oci_execute($data);
        $i = 0;
		echo "tables avant : " . count($tables);
        while(($row = oci_fetch_row($data)) != false)
        {
            //array_push($databases, $row[$i]);
			array_push($tables, $row);
            $i++;
        }
		echo "tables après : " . count($tables);
		
		$typesObj = array();
		$data2 = oci_parse($newDB, 'SELECT DISTINCT OBJECT_TYPE from ALL_OBJECTS');
		oci_execute($data2);
		while(($row2 = oci_fetch_row($data2)) != false)
        {
			array_push($typesObj, $row2);
        }
		
        //var_dump($data);
		include 'views/showDatabase.php';
	}

	public function add()
	{
		$t = new Trajet(array(
			'liaison' => $_POST['liaison'],
			'train' => $_POST['train'],
			'heureDepart' => $_POST['heureDepart']
		));
		$this->trajm->add($t);
		$_SESSION['message'] = 'Le trajet ' . $t->id() . ' a bien été ajouté';
		header('Location: index.php?section=trajet&action=edit');
	}

	public function delete()
	{
		if($this->trajm->exists((int) $_POST['id'])) {
			$t = $this->trajm->get($_POST['id']);
			$this->trajm->delete($t);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'Le trajet ' . $t->id() . ' a bien été supprimé';
		header('Location: index.php?section=trajet&action=edit');
	}

	public function update()
	{
		if($this->trajm->exists((int) $_POST['id'])) {
			$t = $this->trajm->get($_POST['id']);
			$t->hydrate(array(
				'liaison' => $_POST['liaison'],
				'train' => $_POST['train'],
				'heureDepart' => $_POST['heureDepart']
			));
			$this->trajm->update($t);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'Le trajet ' . $t->id() . ' a bien été mis à jour';
		header('Location: index.php?section=trajet&action=edit');
	}
	
	public function afficheInfoTable()
	{	
		$newDB = oci_connect($_SESSION['logDB'], $_SESSION['logPw'], $_SESSION['desc']);

		$data = oci_parse($newDB, "SELECT * FROM " . $_GET['tableName']);
        oci_execute($data);
		
		$nbCol = oci_num_fields($data);
		
		$nomCol = array();
		$typeCol = array();
		$tailleCol = array();
		$nomTable = $_GET['tableName'];
		
		for($i=1 ; $i<=$nbCol ; $i++)
		{
			array_push($nomCol, oci_field_name($data, $i));
			array_push($typeCol, oci_field_type($data, $i));
			array_push($tailleCol, oci_field_size($data, $i));
		}
		
		$data2 = oci_parse($newDB, 'SELECT * FROM ' . $_GET['tableName']);
        oci_execute($data2);
		
		$contTab = array();
		
        while(($row = oci_fetch_row($data2)) != false)
        {
			array_push($contTab, $row);
        }
	
		include 'views/showTableDetails.php';
	}
}

?>