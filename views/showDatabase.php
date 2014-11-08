<section>

<fieldset>
<?php
	for($n=0 ; $n<count($tables) ; $n++)
	{
		echo '<p>Nom : ' . $tables[$n][0] . '</p>';
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