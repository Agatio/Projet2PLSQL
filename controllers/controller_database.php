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

	public function databaselist()
	{
		$databases = $this->databm->getList();
		include 'views/listDatabases.php';
	}

	public function show()
	{
		if(isset($_POST['login']) && isset($_POST['password']) && isset($_GET['dbid']))
		{
			$_SESSION['logDB'] = $_POST['login'];
			$_SESSION['logPw'] = $_POST['password'];
			$_SESSION['dbid'] = $_GET['dbid'];
		}
		
		$database = $this->databm->get($_SESSION['dbid']);
		
		if($database->sgbd() == "oracle")
		{
			$desc = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(Host = ".$database->host().")(Port = ".$database->port()."))
			)
			  (CONNECT_DATA =
				(SERVER = DEDICATED)
				(SID = ". $database->sid() .")
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
		else if($database->sgbd() == "mysql")
		{
			$newDB = new PDO("mysql:dbname="  .$database->db_name() . ";host=" . $database->host()  .";port=" . $database->port() , $_SESSION['logDB'], $_SESSION['logPw']);
			
			$typesObj = array();
			array_push($typesObj, "FONCTION");
			array_push($typesObj, "INDEX");
			array_push($typesObj, "PROCEDURE");
			array_push($typesObj, "TABLE");			
			array_push($typesObj, "TRIGGERS");
			
			$req = $newDB->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $database->db_name() . "'");
			$req->execute();
			
			$tables = array();
			
			while($data = $req->fetch(PDO::FETCH_BOTH))
			{
				array_push($tables, $data);
			}
			
			$req = $newDB->prepare("SELECT ROUTINE_NAME FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_TYPE='FUNCTION'");
			$req->execute();
			
			$fonctions = array();
			
			while($data = $req->fetch(PDO::FETCH_BOTH))
			{
				array_push($fonctions, $data);
			}
			
			$req = $newDB->prepare("SELECT ROUTINE_NAME FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_TYPE='PROCEDURE'");
			$req->execute();
			
			$procedures = array();
			
			while($data = $req->fetch(PDO::FETCH_BOTH))
			{
				array_push($procedures, $data);
			}
			
			$req = $newDB->prepare("SELECT INDEX_NAME FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = '" . $database->db_name() . "'");
			$req->execute();
			
			$index = array();
			
			while($data = $req->fetch(PDO::FETCH_BOTH))
			{
				array_push($index, $data);
			}
			
			$req = $newDB->prepare("SELECT TRIGGERS_NAME FROM INFORMATION_SCHEMA.TRIGGERS");
			$req->execute();
			
			$triggers = array();
			
			while($data = $req->fetch(PDO::FETCH_BOTH))
			{
				array_push($triggers, $data);
			}
				
			include 'views/showDatabaseMySQL.php';
		}
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
	
	public function afficheInfoTableMySQL()
	{
		$database = $this->databm->get($_SESSION['dbid']);
	
		$newDB = new PDO("mysql:dbname="  .$database->db_name()  . ";host=" . $database->host()  .";port=" . $database->port() , $_SESSION['logDB'], $_SESSION['logPw']);
		
		$req = $newDB->prepare("SELECT * FROM " . $_GET['tableName']);
		$req->execute();
		
		$req3 = $newDB->prepare("SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='" . $database->db_name() . "' AND TABLE_NAME='" . $_GET['tableName'] . "' ORDER BY ORDINAL_POSITION");
		$req3->execute();
				
		$nbCol = $req->columnCount();
		
		$nomCol = array();
		$typeCol = array();
		$tailleCol = array();
		$tailleColNum = array();
		$nomTable = $_GET['tableName'];
		
		while($dataCol = $req3->fetch(PDO::FETCH_BOTH))
		{
			array_push($nomCol, $dataCol['COLUMN_NAME']);
			array_push($typeCol, $dataCol['DATA_TYPE']);
			array_push($tailleCol, $dataCol['CHARACTER_MAXIMUM_LENGTH']);
			array_push($tailleColNum, $dataCol['NUMERIC_PRECISION']);
		}
		
		//$dataCol = $req2->fetch(PDO::FETCH_BOTH));
		
		/*for($i=0 ; $i<=$nbCol ; $i++)
		{
			array_push($nomCol, $dataCol);
			array_push($typeCol, $meta['mySQL:decl_type']);
			array_push($tailleCol, $meta['len']);
		}*/
		
		$req2 = $newDB->prepare("SELECT * FROM " . $_GET['tableName']);
		$req2->execute();
		
		$contTab = array();
		
		while($data = $req->fetch(PDO::FETCH_BOTH))
		{
			array_push($contTab, $data);
		}
		
	
		include 'views/showTableDetails.php';
	}
}

?>