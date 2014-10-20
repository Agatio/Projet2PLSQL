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

include 'views/connexion.php';

$content = ob_get_clean();

?>

<?php
echo $content;

include 'views/footer_front.php';


?>

</body>
</html>
