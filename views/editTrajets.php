<section>

<fieldset>
<legend>Déjà enregistrés :</legend>
<?php
foreach ($trajets as $t) {
	echo '<form method="post">';
	echo '<input type="hidden" value="' . $t->id() . '" name="id" />';
	echo '<select name="liaison">';
	foreach ($liaisons as $l) {
		$vd = $this->vm->get($l->villeDepart());
		$va = $this->vm->get($l->villeArrivee());
		echo '<option value="'.$l->id().'"';
		if ($l->id() == $t->liaison()) {
			echo ' selected="selected"';
		}
		echo '>'.$vd->nom().'->'.$va->nom().' ('.$l->longueur().'km)</option>';
	}
	echo '</select>';
	echo '<select name="train">';
	foreach ($trains as $tr) {
		echo '<option value="'.$tr->id().'"';
		if ($tr->id() == $t->train()) {
			echo ' selected="selected"';
		}
		echo '>'.$tr->nbPlaces().'pl. / '.$tr->vitesse().'km/h</option>';
	}
	echo '</select>';
	echo '<input type="time" name="heureDepart"  value="'.$t->heureDepart().'"/>';
	$train = $this->trainm->get($t->train());
	$liaison = $this->lm->get($t->liaison());
	$duree = $liaison->longueur() / $train->vitesse() * 3600;
	echo '<label> (Durée : '.sec2hms($duree).') </label>';
	echo '<input type="button" value="Modifier" onclick="modifyButtonClicked(event)" />';
	echo '<input type="button" value="Supprimer" onclick="deleteButtonClicked(event)" />';
	echo '</form>';
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
	f.action = 'index.php?section=trajet&action=delete';
	f.submit();
}
</script>

<form action="index.php?section=trajet&amp;action=add" method="post">
	<fieldset>
	<legend>Ajout :</legend>
		<?php
		echo '<label>Liaison : </label> ';
		echo '<select name="liaison">';
		foreach ($liaisons as $l) {
			$vd = $this->vm->get($l->villeDepart());
			$va = $this->vm->get($l->villeArrivee());
			echo '<option value="'.$l->id().'">'.$vd->nom().'->'.$va->nom().' ('.$l->longueur().'km)</option>';
		}
		echo '</select> <br />';
		echo '<label>Train : </label> ';
		echo '<select name="train">';
		foreach ($trains as $tr) {
			echo '<option value="'.$tr->id().'">'.$tr->nbPlaces().'pl. / '.$tr->vitesse().'km/h</option>';
		}
		echo '</select> <br />';
		echo '<label>Heure de départ : </label> ';
		echo '<input type="time" name="heureDepart" /> <br />';
		?>
		<input type="submit" value="Ajouter" />
	</fieldset>
</form>

</section>