<section> 
	<?php
		echo $_GET['tableName'];
		
		echo $nbCol;
		echo "<p><strong>Structure : </strong></p>";
		for($z=0; $z<$nbCol ; $z++)
		{
			echo "<p>Nom : " . $nomCol[$z] . " Type : " . $typeCol[$z] . " Taille : " . $tailleCol[$z] . "</p>";
		}
		
		echo "<p><strong>Contenu : </strong></p>";
		
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
		
		echo "<p><strong>Script : </strong></p>";
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
		echo "<p>)</p>";

	?>
</section>