<h1>Application de gestion de bases de données</h1>
<section>
	<fieldset>
		<?php
			for($z=0 ; $z<count($typesObj) ; $z++)
			{
				echo "<fieldset id='objTrouv'>";
				echo '<legend>' . $typesObj[$z][0] . '</legend>';
				
				for($y=0 ; $y<count($tables) ; $y++)
				{
					if($tables[$y][1] == $typesObj[$z][0])
					{
						if($typesObj[$z][0] == 'TABLE')
						{
							echo '<p><a href="index.php?section=database&action=afficheInfoTable&tableName=' . $tables[$y][0] .'">' . $tables[$y][0] . '</a></p>';
						}
						else if($typesObj[$z][0] == 'VIEW')
						{
							echo '<p><a href="index.php?section=database&action=afficheInfoView&viewName=' . $tables[$y][0] .'">' . $tables[$y][0] . '</a></p>';
						}
						else if($typesObj[$z][0] == 'FUNCTION' || $typesObj[$z][0] == 'PROCEDURE' || $typesObj[$z][0] == 'PACKAGE' || $typesObj[$z][0] == 'TRIGGER')
						{
							echo '<p><a href="index.php?section=database&action=afficheCodeObj&objName=' . $tables[$y][0] .'">' . $tables[$y][0] . '</a></p>';
						}
						else
						{
							echo '<p>' . $tables[$y][0] . '</p>';
						}
					}
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