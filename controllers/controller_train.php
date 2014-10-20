<?php

require_once 'controllers/controller.php';

require_once 'models/trainManager.php';

class Controller_Train extends Controller
{
	private $tm;

	public function __construct()
	{
		parent::__construct();
		$this->tm = new TrainManager($this->db);
	}

	public function edit()
	{
		$trains = $this->tm->getList();
		include 'views/editTrains.php';
	}

	public function add()
	{
		$t = new Train(array(
			'nbPlaces' => $_POST['nbPlaces'],
			'vitesse' => $_POST['vitesse']
		));
		$this->tm->add($t);
		$_SESSION['message'] = 'Le train (' . $t->nbPlaces() . ' places / ' . $t->vitesse() . ' km/h) a bien été ajouté';
		header('Location: index.php?section=train&action=edit');
	}

	public function delete()
	{
		if($this->tm->exists((int) $_POST['id'])) {
			$t = $this->tm->get($_POST['id']);
			$this->tm->delete($t);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'Le train ' . $t->id() . ' a bien été supprimé';
		header('Location: index.php?section=train&action=edit');
	}

	public function update()
	{
		if($this->tm->exists((int) $_POST['id'])) {
			$t = $this->tm->get($_POST['id']);
			$t->hydrate(array(
				'nbPlaces' => $_POST['nbPlaces'],
				'vitesse' => $_POST['vitesse']
			));
			$this->tm->update($t);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'Le train ' . $t->id() . ' a bien été mis à jour';
		header('Location: index.php?section=train&action=edit');
	}
}

?>