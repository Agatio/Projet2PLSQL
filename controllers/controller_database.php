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
		if(isset($_POST['login']) && isset($_POST['password']) && isset($_GET['dbid']) && isset($_POST['SID']))
		{
			$_SESSION['logDB'] = $_POST['login'];
			$_SESSION['logPw'] = $_POST['password'];
			$_SESSION['dbid'] = $_GET['dbid'];
			$_SESSION['sid'] = $_POST['SID'];
		}
		
		$database = $this->databm->get($_SESSION['dbid']);
		
		$desc = "(DESCRIPTION =
	    (ADDRESS_LIST =
	      (ADDRESS = (PROTOCOL = TCP)(Host = ".$database->host().")(Port = ".$database->port()."))
	    )
		  (CONNECT_DATA =
		    (SERVER = DEDICATED)
		    (SID = ".$_SESSION['sid'].")
		  )
		)";
		$_SESSION['desc'] = $desc;
		
		
		$newDB = oci_connect($_SESSION['logDB'], $_SESSION['logPw'], $desc);
		

		$tables = array();
        //$data = oci_parse($newDB, 'SELECT ALL_ALL_TABLES FROM dict');
		//$data = oci_parse($newDB, 'SELECT TABLE_NAME from ALL_ALL_TABLES');
		$data = oci_parse($newDB, 'SELECT OBJECT_NAME, OBJECT_TYPE from USER_OBJECTS ORDER BY OBJECT_TYPE, OBJECT_NAME');
        oci_execute($data);
        $i = 0;
        while(($row = oci_fetch_row($data)) != false)
        {
            //array_push($databases, $row[$i]);
			array_push($tables, $row);
            $i++;
        }
		
		$typesObj = array();
		$data2 = oci_parse($newDB, 'SELECT DISTINCT OBJECT_TYPE from USER_OBJECTS ORDER BY OBJECT_TYPE');
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
	
	public function afficheInfoView()
	{	
		$newDB = oci_connect($_SESSION['logDB'], $_SESSION['logPw'], $_SESSION['desc']);
		$data = oci_parse($newDB, 'SELECT * FROM ' . $_GET['viewName']);
        oci_execute($data);
		
		$contView = array();
		
        while(($row = oci_fetch_row($data)) != false)
        {
			array_push($contView, $row);
        }
		
		$data2 = oci_parse($newDB, "SELECT * FROM " . $_GET['viewName']);
        oci_execute($data2);
		
		$nbCol = oci_num_fields($data2);
		
		$nomCol = array();
		$typeCol = array();
		$tailleCol = array();
		$nomTable = $_GET['viewName'];
		
		for($i=1 ; $i<=$nbCol ; $i++)
		{
			array_push($nomCol, oci_field_name($data2, $i));
			array_push($typeCol, oci_field_type($data2, $i));
			array_push($tailleCol, oci_field_size($data2, $i));
		}
		
		$nomTabUsed = array();
		$data3 = oci_parse($newDB, "select referenced_name from user_dependencies where name = '" . $_GET['viewName'] . "' and type = 'VIEW' and referenced_type = 'TABLE'");
        oci_execute($data3);
		
		while(($row = oci_fetch_row($data3)) != false)
        {
			array_push($nomTabUsed, $row);
        }
		
		
		include 'views/showViewDetails.php';
	}
	
	public function afficheCodeObj()
	{	
		$newDB = oci_connect($_SESSION['logDB'], $_SESSION['logPw'], $_SESSION['desc']);
		$data = oci_parse($newDB, "select text from USER_SOURCE where name = '" . $_GET['objName'] . "'");
        oci_execute($data);
		
		$contObj = array();
		
        while(($row = oci_fetch_row($data)) != false)
        {
			array_push($contObj, $row);
        }
		
		include 'views/showCodeDetails.php';
	}
}

?>