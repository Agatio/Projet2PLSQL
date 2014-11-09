<?php

require_once 'controllers/controller.php';

require_once 'models/userManager.php';

class Controller_User extends Controller
{
	private $um;

	public function __construct()
	{
		parent::__construct();
		$this->um = new UserManager($this->db);
	}

	public function create()
	{
		if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordCheck']))
		{
			if (! $this->um->exists($_POST['login']))
			{
				if($_POST['login']!="" && $_POST['password']!="")
				{
					if ($_POST['password'] == $_POST['passwordCheck'])
					{
						$u = new User(array(
							'login' => $_POST['login'],
							'password' => encodePassword($_POST['password'])
						));
						$this->um->add($u);
						$_SESSION['message'] = 'L\'utilisateur '.$_POST['login'].' a été créé. Vous pouvez vous connecter';
						header('Location: index.php');
					}
					else
					{
						$_SESSION['message'] = 'Le même mot de passe n\'a pas été entré deux fois';
						header('Location: index.php?section=user&action=create');
					}
				}
				else
				{
					$_SESSION['message'] = "T'es con ? pas d'utilisateur vide";
					header('Location: index.php?section=user&action=create');
				}
			}
			else
			{
				$_SESSION['message'] = 'L\'utilisateur '.$_POST['login'].' existe déjà';
				header('Location: index.php');
			}
		}
		else
		{
			include 'views/createUser.php';
		}
	}

	public function connect()
	{
		if (isset($_POST['username']) && isset($_POST['passwd']))
		{
			if ($this->um->exists($_POST['username']))
			{
				$u = $this->um->get($_POST['username']);
				if ($u->passwd() == $_POST['passwd'])
				{
					$_SESSION['user_id'] = $u->user_id();
					$_SESSION['username'] = $u->username();
					//header('Location: index.php');
					//exit();
				} else
				{
					//$_SESSION['message'] = 'Mot de passe incorrect';
					//header('Location: index.php?section=user&action=connect');
				}
			} else
			{
				$_SESSION['message'] = 'L\'utilisateur '.$_POST['username'].' n\'existe pas';
				header('Location: index.php?section=user&action=connect');
			}
		}
	}

	public function disconnect()
	{
		if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
			unset($_SESSION['user_id']);
			unset($_SESSION['username']);
			
			unset($_SESSION['logDB']);
			unset($_SESSION['logPw']);
			unset($_SESSION['desc']);
			unset($_SESSION['dbid']);		
			
			header('Location: index.php');
		}
	}
	
	public function verif()
	{
		if(isset($_GET['login']))
		{
			$_GET['login']=htmlspecialchars($_GET['login']);
			$_SESSION['dispo']=0;
				if ($this->um->exists($_GET['login']))
				{
					$_SESSION['message']="Le nom d'utilisateur est déjà présent";
				}
				else
				{
					$_SESSION['message']="Le nom d'utilisateur est disponible";
				}

		}
		else
		{
			$_SESSION['message']="Le nom d'utilisateur n'a pas été saisis";
		}
	}
	
	public function verif_m()
	{
		if(isset($_GET['mdp_verif']) && isset($_GET['mdp']))
		{
			$_GET['mdp']=htmlspecialchars($_GET['mdp']);
			$_GET['mdp_verif']=htmlspecialchars($_GET['mdp_verif']);
			$_SESSION['dispo']=0;
			
			if(strlen($_GET['mdp'])<6 || strlen($_GET['mdp_verif'])<6)
			{
				$_SESSION['message']="Le mot de passe doit faire contenir au moins 6 caractères";
			}
			else
			{
				if(!(preg_match('/[A-Za-z]/', $_GET['mdp']) && preg_match('/[0-9]/', $_GET['mdp'])) || !(preg_match('/[A-Za-z]/', $_GET['mdp_verif']) && preg_match('/[0-9]/', $_GET['mdp_verif'])))
				{
					$_SESSION['message']="Le mot de passe doit contenir au moins une lettre en majuscule, une lettre en miniscule et un chiffre";
				}
				else
				{
					if($_GET['mdp']==$_GET['mdp_verif'])
					{
						$_SESSION['message']="Les mots de passes correspondent";
					}
					else
					{
						$_SESSION['message']="Les mots de passes ne correspondent pas";
					}
				}
			}
		}
		else
		{
			$_SESSION['message']="Aucun mot de passe n'a été saisis";
		}
		
	}
}

?>