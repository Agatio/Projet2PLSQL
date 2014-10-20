<section>

<fieldset>
<legend>Déjà enregistrés :</legend>
<?php
foreach($trains as $t) {
	echo '<form method="post">';
	echo '<input type="hidden" value="' . $t->id() . '" name="id" />';
	echo '<label> Nombre de places : </label>';
	echo '<input type="number" value="' . $t->nbPlaces() . '" name="nbPlaces" />';
	echo '<label> Vitesse : </label>';
	echo '<input type="number" value="' . $t->vitesse() . '" name="vitesse" />';
	echo '<input type="button" value="Modifier" onclick="modifyButtonClicked(event)" />';
	echo '<input type="button" value="Supprimer" onclick="deleteButtonClicked(event)" />';
	echo '</form>';
}
?>
</fieldset>

<script>
function modifyButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=train&action=update';
	f.submit();
}
function deleteButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=train&action=delete';
	f.submit();
}
</script>

<form action="index.php?section=train&amp;action=add" method="post">
	<fieldset>
	<legend>Ajout :</legend>
		<label>Nombre de places : </label>
		<input type="number" name="nbPlaces" value="0" /> <br />
		<label>Vitesse : </label>
		<input type="number" name="vitesse" value="0" /> <br />
		<input type="submit" value="Ajouter" />
	</fieldset>
</form>

</section>