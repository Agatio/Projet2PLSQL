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

		$tables = array();
        //$data = oci_parse($newDB, 'SELECT ALL_ALL_TABLES FROM dict');
		$data = oci_parse($newDB, 'SELECT TABLE_NAME from ALL_ALL_TABLES');
        oci_execute($data);
        $i = 0;
		echo "tables avant : " . count($tables);
        while(($row = oci_fetch_row($data)) != false)
        {;
            //array_push($databases, $row[$i]);
			array_push($tables, $row);
            $i++;
        }
		echo "tables après : " . count($tables);
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
}

?>