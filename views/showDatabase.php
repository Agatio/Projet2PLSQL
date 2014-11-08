<section>

<fieldset>
<?php
	/*echo "il y a " . count($typesObj) . " différents objets.";

	for($n=0 ; $n<count($tables) ; $n++)
	{
		echo '<p>Type : ' . $tables[$n][1] . ' Nom : ' . $tables[$n][0] . '</p>';
	}*/
	
	for($z=0 ; $z<count($typesObj) ; $z++)
	{
		echo '<p><strong>' . $typesObj[$z][0] . '</strong></p>';
		
		for($y=0 ; $y<count($tables) ; $y++)
		{
			if($tables[$y][1] == $typesObj[$z][0])
			{
				if($typesObj[$z][0] == 'TABLE')
				{
					echo '<p>Nom : <a href="index.php?section=database&action=afficheInfoTable&tableName=' . $tables[$y][0] .'">' . $tables[$y][0] . '</a></p>';
				}
				else
				{
					echo '<p>Nom : ' . $tables[$y][0] . '</p>';
				}
			}
		}
	}

	
	
	
	
	
	
	
	
	
	
	
	
	/*echo '<p>Nom : '.$database->db_name().' </p>';
	echo '<p>Domaine : '.$database->db_domain().' </p>';
	echo '<p>Hôte : '.$database->host().':'.$database->port().' </p>';*/
	echo 'Connexion reussie';

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