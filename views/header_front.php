<header>
	<h1> <a href="index.php">Trafic ferroviaire</a> </h1>
</header>

<nav>
	<ul>
		<li><a href="index.php?section=reservation&amp;action=search">Recherche</a></li>
		<?php
			if (!isset($_SESSION['userid'])) {
				?>
				<li><a href="index.php?section=user&amp;action=connect">Se connecter</a></li>
				<?php
			} else {
				?>
				<li><a href="index.php?section=reservation&amp;action=show">Mes réservations</a></li>
				<?php
			}
		?>
	</ul>
</nav>