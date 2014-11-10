<section>
	<fieldset>
		<?php			
			for($z=0 ; $z<count($typesObj) ; $z++)
			{
				if($z==0 && count($fonctions) > 0)
				{
					echo "<br/><fieldset id='objTrouv'>";
					echo '<legend>' . $typesObj[$z] . '</legend>';
				
					for($y=0 ; $y<count($fonctions) ; $y++)
					{
						echo '<p><a href="#">' . $fonctions[$y][0] . '</a></p>';
					}
					
					echo "</fieldset>";
				}
				else if($z==1 && count($index) > 0)
				{
					echo "<br/><fieldset id='objTrouv'>";
					echo '<legend>' . $typesObj[$z] . '</legend>';
				
					for($y=0 ; $y<count($index) ; $y++)
					{
						echo '<p><a href="#">' . $index[$y][0] . '</a></p>';
					}
					
					echo "</fieldset>";
				}
				else if($z==2 && count($procedures) > 0)
				{
					echo "<br/><fieldset id='objTrouv'>";
					echo '<legend>' . $typesObj[$z] . '</legend>';
				
					for($y=0 ; $y<count($procedures) ; $y++)
					{
						echo '<p><a href="#">' . $procedures[$y][0] . '</a></p>';
					}
					
					echo "</fieldset>";
				}
				else if($z==3 && count($tables) > 0)
				{
					echo "<br/><fieldset id='objTrouv'>";
					echo '<legend>' . $typesObj[$z] . '</legend>';
					
					for($y=0 ; $y<count($tables) ; $y++)
					{
						echo '<p><a href="index.php?section=database&action=afficheInfoTableMySQL&tableName=' . $tables[$y][0] .'">' . $tables[$y][0] . '</a></p>';
					}
					
					echo "</fieldset>";
				}
				else if($z==4 && count($triggers) > 0)
				{
					echo "<br/><fieldset id='objTrouv'>";
					echo '<legend>' . $typesObj[$z] . '</legend>';
					
					for($y=0 ; $y<count($triggers) ; $y++)
					{
						echo '<p><a href="#">' . $triggers[$y][0] . '</a></p>';
					}
					
					echo "</fieldset>";
				}

				echo "</fieldset>";
			}
		?>
	</fieldset>

	<script>
	function modifyButtonClicked(e) {
		var f = e.target.parentNode;
		f.action = 'index.php?section=trajet&action=update';
		f.submit();
	}
	function deleteButtonClicked(e) {
		var f = e.target.parentNode;
		f.action = 'index.php?section=database&action=show';
		f.submit();
	}
	</script>

</section>