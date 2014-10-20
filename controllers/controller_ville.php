<?php

require_once 'controllers/controller.php';

require_once 'models/villeManager.php';

class Controller_Ville extends Controller
{
	private $vm;

	public function __construct()
	{
		parent::__construct();
		$this->vm = new VilleManager($this->db);
	}

	public function edit()
	{
		$villes = $this->vm->getList();
		include 'views/editVilles.php';
	}

	public function add()
	{
		$v = new Ville(array(
			'nom' => $_POST['nom'],
			'lat' => $_POST['lat'],
			'lng' => $_POST['lng']
		));
		$this->vm->add($v);
		$_SESSION['message'] = 'La ville ' . $v->id() . ' (' . $v->nom() . ') a bien été ajoutée';
		header('Location: index.php?section=ville&action=edit');
	}

	public function delete()
	{
		if($this->vm->exists((int) $_POST['id'])) {
			$v = $this->vm->get($_POST['id']);
			$this->vm->delete($v);
		} else {
			echo $id . ' n\'existe pas';
		}
		$_SESSION['message'] = 'La ville ' . $v->id() . ' (' . $v->nom() . ') a bien été supprimée';
		header('Location: index.php?section=ville&action=edit');
	}

	public function update()
	{
		if($this->vm->exists((int) $_POST['id'])) {
			$v = $this->vm->get($_POST['id']);
			$v->hydrate(array(
				'nom' => $_POST['nom'],
				'lat' => $_POST['lat'],
				'lng' => $_POST['lng']
			));
			$this->vm->update($v);
		} else {
			echo $id . ' n\'existe pas';
		}
		$_SESSION['message'] = 'Le nom de la ville (' . $v->nom() . ') a bien été mis à jour';
		header('Location: index.php?section=ville&action=edit');
	}

	public function verif_v()
	{
		if(isset($_GET['name']))
		{
			$_GET['name']=htmlspecialchars($_GET['name']);
			$_SESSION['dispo']=0;
			if($_GET['name'] != '')
			{
				if ($this->vm->exists_nom($_GET['name']))
				{
					$_SESSION['message']="La ville est déjà présente";
				}
				else
				{
					$_SESSION['message']="La ville est disponible";
				}
			}
			else
			{
				unset($_SESSION['message']);
			}
		}
		else
		{
			$_SESSION['message']="La ville n'a pas été saisie";
		}
	}
}

?>