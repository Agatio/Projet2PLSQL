<section>

<fieldset>
<legend>Déjà enregistrées :</legend>
<?php
foreach ($liaisons as $l) {
	echo '<form method="post">';
	echo '<input type="hidden" value="' . $l->id() . '" name="id" />';
	echo '<select name="villeDepart">';
	foreach ($villes as $v) {
		echo '<option value="'.$v->id().'"';
		if ($v->id() == $l->villeDepart()) {
			echo ' selected="selected"';
		}
		echo '>'.$v->nom().'</option>';
	}
	echo '</select>';
	echo '<span> -> </span>';
	echo '<select name="villeArrivee">';
	foreach ($villes as $v) {
		echo '<option value="'.$v->id().'"';
		if ($v->id() == $l->villeArrivee()) {
			echo ' selected="selected"';
		}
		echo '>'.$v->nom().'</option>';
	}
	echo '</select>';
	echo '<label> Longueur : </label>';
	echo '<input type="number" name="longueur" value="'.$l->longueur().'" />';
	echo '<input type="button" value="Modifier" onclick="modifyButtonClicked(event)" />';
	echo '<input type="button" value="Supprimer" onclick="deleteButtonClicked(event)" />';
	echo '</form>';
}
?>
</fieldset>

<script>
function modifyButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=liaison&action=update';
	f.submit();
}
function deleteButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=liaison&action=delete';
	f.submit();
}
</script>

<form action="index.php?section=liaison&amp;action=add" method="post">
	<fieldset>
	<legend>Ajout :</legend>
		<?php
		echo '<label>Ville de départ : </label> ';
		echo '<select name="villeDepart">';
		foreach ($villes as $v) {
			echo '<option value="'.$v->id().'">'.$v->nom().'</option>';
		}
		echo '</select> <br />';
		echo '<label>Ville d\'arrivée : </label> ';
		echo '<select name="villeArrivee">';
		foreach ($villes as $v) {
			echo '<option value="'.$v->id().'">'.$v->nom().'</option>';
		}
		echo '</select> <br />';
		echo '<label>Longueur : </label>';
		echo '<input type="number" name="longueur" value="0" /> <br />';
		?>
		<input type="submit" value="Ajouter" />
	</fieldset>
</form>

</section>