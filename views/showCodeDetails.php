<section>
	<?php
		echo "<p><strong>Contenu : </strong></p>";
		
		for($z=0 ; $z<count($contObj) ; $z++)
		{
			for($y=0 ; $y<count($contObj[$z]) ; $y++)
			{
				echo "<p>" . $contObj[$z][$y] . "</p>";
			}
		}
		
		echo "<a href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a>"
	?>
</section>