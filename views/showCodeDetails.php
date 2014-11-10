<section>
	<div class="results">
		<?php
			echo "<br/><a class='btnRet' href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a><br/><br/>";
			echo "<p><strong>Contenu : </strong></p><br/>";
			
			for($z=0 ; $z<count($contObj) ; $z++)
			{
				for($y=0 ; $y<count($contObj[$z]) ; $y++)
				{
					echo "<p>" . $contObj[$z][$y] . "</p>";
				}
			}
		?>
	</div>
</section>