<?php

require_once 'controllers/controller.php';

require_once 'models/villeManager.php';
require_once 'models/liaisonManager.php';

class Controller_Liaison extends Controller
{
	private $vm;
	private $lm;

	public function __construct()
	{
		parent::__construct();
		$this->vm = new VilleManager($this->db);
		$this->lm = new LiaisonManager($this->db);
	}

	public function edit()
	{
		$liaisons = $this->lm->getList();
		$villes = $this->vm->getList();
		include 'views/editLiaisons.php';
	}

	public function add()
	{
		$l = new Liaison(array(
			'villeDepart' => $_POST['villeDepart'],
			'villeArrivee' => $_POST['villeArrivee'],
			'longueur' => $_POST['longueur']
		));
		$this->lm->add($l);
		$_SESSION['message'] = 'La liaison entre les villes ' . $l->villeDepart() . ' et ' . $l->villeArrivee() . ' a bien été ajoutée';
		header('Location: index.php?section=liaison&action=edit');
	}

	public function delete()
	{
		if($this->lm->exists((int) $_POST['id'])) {
			$l = $this->lm->get($_POST['id']);
			$this->lm->delete($l);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'La liaison ' . $l->id() . ' a bien été supprimée';
		header('Location: index.php?section=liaison&action=edit');
	}

	public function update()
	{
		if($this->lm->exists((int) $_POST['id'])) {
			$l = $this->lm->get($_POST['id']);
			$l->hydrate(array(
				'villeDepart' => $_POST['villeDepart'],
				'villeArrivee' => $_POST['villeArrivee'],
				'longueur' => $_POST['longueur']
			));
			$this->lm->update($l);
		} else {
			echo $_POST['id'] . ' n\'existe pas';
		}
		$_SESSION['message'] = 'La liaison ' . $l->id() . ' a bien été mise à jour';
		header('Location: index.php?section=liaison&action=edit');
	}
}

?>