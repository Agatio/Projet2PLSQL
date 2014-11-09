<section> 
	<?php
		echo "<p><strong>Contenu : </strong></p>";
		
		echo "<table>";
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
		
		echo "<p><strong>Script : </strong></p>";
		
		echo "<p>CREATE VIEW " . $_GET['viewName'] . " as SELECT ";
		for($z=0; $z<$nbCol ; $z++)
		{
			if($nbCol == $nbCol-1)
			{
				echo $nomCol[$z] . " ";
			}
			else
			{
				echo $nomCol[$z] . ", ";
			}
			
		}
		echo "FROM " . $nomTabUsed[0][0] . "</p>";
		
		echo "<a href='index.php?section=database&action=show&dbid=" . $_SESSION['dbid'] . "'>Retour</a>"
	?>
</section>