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