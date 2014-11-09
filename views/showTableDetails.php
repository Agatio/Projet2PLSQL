<section> 
	<div class="results">
		<?php
			echo "<p><strong>Structure : </strong></p><br/>";
			
			echo "<table>";
			echo "<tr>";
				echo "<td>Nom colonne</td>";
				echo "<td>Type</td>";
				echo "<td>Taille</td>";
			echo "</tr>";
			for($z=0; $z<$nbCol ; $z++)
			{
				echo "<tr>";
					echo "<td>" . $nomCol[$z] . "</td>";
					echo "<td>" . $typeCol[$z] . "</td>";
					echo "<td>" . $tailleCol[$z] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<br/><p><strong>Contenu : </strong></p><br/>";
			
			echo "<table>";
			echo "<tr>";
			
			for($z=0; $z<$nbCol ; $z++)
			{
				echo "<td>" . $nomCol[$z] . "</td>";
			}
			echo "</tr>";
			
			for($z=0; $z<count($contTab) ; $z++)
			{
				echo "<tr>";
				for($y=0 ; $y<$nbCol ; $y++)
				{
					echo "<td>" . $contTab[$z][$y] . "</td>";
				}
				
				echo "</tr>";
			}
			
			echo "</table>";
			
			echo "<br/><p><strong>Script : </strong></p><br/>";
			echo "<p>CREATE TABLE " . $nomTable . "</p>";
			echo "<p>(</p>";
			for($z=0; $z<$nbCol ; $z++)
			{
				if($z == $nbCol-1)
				{
					echo "<p>" . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleCol[$z] . ")</p>";
				}
				else
				{
					echo "<p>" . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleCol[$z] . "),</p>";
				}
				
			}
			echo "<p>);</p>";
			echo "<a href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a>"
		?>
	</div>
</section>