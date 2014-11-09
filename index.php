<?php

session_start();

include 'global/config.php';
include 'global/helpers.php';

ob_start();

$notfound = false;

if (!empty($_GET['section'])) {
	$controller_file = dirname(__FILE__).'/controllers/controller_'.$_GET['section'].'.php';
	if (is_file($controller_file)) {
		include $controller_file;
		$controller_name = 'Controller_'.ucfirst($_GET['section']);
		if (class_exists($controller_name)) {
			$c = new $controller_name;
			$action = $_GET['action'];
			if (method_exists($c, $action)) {
				$c->$action();
			} else {
				$notfound = true;
			}
		} else {
			$notfound = true;
		}
	} else {
		$notfound = true;
	}
} else {
	$notfound = true;
}

$content = ob_get_clean();

echo "<!DOCTYPE html>";
echo "<html>";
	echo "<head>";
		echo "<meta charset='UTF-8'>";
		echo "<title>Accueil</title>";
		echo "<link rel='stylesheet' type='text/css' href='style/style.css'>";
	echo "</head>";
	echo "<body>";
		echo '<div class="contenu">';
			echo '<h1>Application de gestion de bases de données</h1>';

			if(isset($_SESSION['user_id']))
			{
				include 'views/home_front.php';
			}
			else
			{
				include 'views/connexion.php';
			}

			echo $content;

		echo '</div>';
		include 'views/footer_front.php';		
	echo "</body>";
echo "</html>";
?>

</body>
</html>
