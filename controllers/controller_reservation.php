<?php

require_once 'controllers/controller.php';

require_once 'models/reservationManager.php';
require_once 'models/trajetManager.php';
require_once 'models/trainManager.php';
require_once 'models/liaisonManager.php';
require_once 'models/villeManager.php';

class Controller_Reservation extends Controller
{
	private $rm;
	private $tm;
	private $lm;
	private $vm;
	private $trainm;

	public function __construct()
	{
		parent::__construct();
		$this->rm = new ReservationManager($this->db);
		$this->tm = new TrajetManager($this->db);
		$this->lm = new LiaisonManager($this->db);
		$this->vm = new VilleManager($this->db);
		$this->trainm = new TrainManager($this->db);
	}

	public function show()
	{
		if (isset($_SESSION['userid'])) {
			$resas = $this->rm->getList($_SESSION['userid']);
			include 'views/showReservations.php';
		} else {
			$_SESSION['message'] = 'Aucun utilisateur connecté';
			header('Location: index.php');
		}
	}

	public function search()
	{
		$villes = $this->vm->getList();
		include 'views/search.php';

		if (isset($_POST['villeDepart']) && isset($_POST['villeArrivee'])){
			$results = array();
			$trajets = $this->tm->getList();
			foreach ($trajets as $t) {
				$l = $this->lm->get($t->liaison());
				$vd = $this->vm->get($l->villeDepart());
				$va = $this->vm->get($l->villeArrivee());
				if ($vd->id() == $_POST['villeDepart'] && $va->id() == $_POST['villeArrivee']) {
					$results[] = $t;
				}
			}
			include 'views/results.php';
		}
	}

	public function make()
	{
		if (isset($_SESSION['userid'])) {
			$r = new Reservation(array(
				'user' => $_SESSION['userid'],
				'trajet' => $_GET['trajet']
			));
			$c1 = 'reservation -> '.$r->id().' / '.$r->user().' / '.$r->trajet();
			$this->rm->add($r);
			$c2 = 'obtained id -> '.$r->id();
			
			$_SESSION['message'] = 'La réservation a bien été enregistrée // '.$c1.' // '.$c2;
			header('Location: index.php?section=reservation&action=show');
		} else {
			$_SESSION['message'] = 'Aucun utilisateur connecté';
			header('Location: index.php');
		}
	}
}

?>