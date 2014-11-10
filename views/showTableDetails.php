<section> 
	<div class="results">
		<?php
			echo "<br/><a class='btnRet' href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a><br/><br/>";
			echo "<p><strong>Structure : </strong></p><br/>";
			
			echo "<table class='tabDP'>";
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
					if($tailleCol[$z] != null)
					{
						echo "<td>" . $tailleCol[$z] . "</td>";
					}
					else
					{
						echo "<td>" . $tailleColNum[$z] . "</td>";
					}
				echo "</tr>";
			}
			echo "</table>";
			
			echo "<br/><p><strong>Contenu : </strong></p><br/>";
			
			echo "<table class='tabDP'>";
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
			
			$test = "";

			for($z=0; $z<$nbCol ; $z++)
			{
				if($z == $nbCol-1)
				{
					if($tailleCol[$z] != null)
					{
						$test = $test . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleCol[$z] . ")\n";
					}
					else
					{
						$test = $test . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleColNum[$z] . ")\n";
					}
				}
				else
				{
					if($tailleCol[$z] != null)
					{
						$test = $test . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleCol[$z] . "),\n\t";
					}
					else
					{
						$test = $test . $nomCol[$z] . " " . $typeCol[$z] . "(" . $tailleColNum[$z] . "),\n\t";
					}
				}
			};
			
			
			echo "<textarea rows='15' cols='50' wrap='on'>
CREATE TABLE " . $nomTable . "\n(\n\t" . $test . " );
			</textarea>";
		?>
	</div>
</section>