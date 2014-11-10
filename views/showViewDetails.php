<section> 
	<div class="results">
		<?php
			echo "<br/><a class='btnRet' href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a><br/><br/>";
			echo "<p><strong>Contenu : </strong></p><br/>";
			
			echo "<table class='tabDP'>";
			echo "<tr>";
			
			for($z=0; $z<$nbCol ; $z++)
			{
				echo "<td>" . $nomCol[$z] . "</td>";
			}
			echo "</tr>";
			
			for($z=0; $z<count($contView) ; $z++)
			{
				echo "<tr>";
				for($y=0 ; $y<$nbCol ; $y++)
				{
					echo "<td>" . $contView[$z][$y] . "</td>";
				}
				
				echo "</tr>";
			}
			
			echo "</table>";
			
			echo "<br/><p><strong>Script : </strong></p><br/>";
			
			echo "<pre class='fondBlanc'>CREATE VIEW " . $_GET['viewName'] . " as SELECT ";
			for($z=0; $z<$nbCol ; $z++)
			{
				if($z == $nbCol-1)
				{
					echo $nomCol[$z] . " ";
				}
				else
				{
					echo $nomCol[$z] . ", ";
				}
				
			}
			echo "FROM " . $nomTabUsed[0][0] . ";</pre>";
		?>
	</div>
</section>