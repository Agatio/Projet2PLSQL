<section id="formville">

<fieldset>
<legend>Déjà enregistrées :</legend>
<?php
foreach($villes as $v) {
	echo '<form method="post">';
	echo '<input type="hidden" value="' . $v->id() . '" name="id" />';
	echo '<input type="text" value="' . $v->nom() . '" name="nom" />';
	echo '<input type="number" value="' . $v->lat() . '" name="lat" />';
	echo '<input type="number" value="' . $v->lng() . '" name="lng" />';
	echo '<input type="button" value="Modifier" onclick="modifyButtonClicked(event)" />';
	echo '<input type="button" value="Supprimer" onclick="deleteButtonClicked(event)" />';
	echo '</form>';
}
?>
</fieldset>

<script>
function modifyButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=ville&action=update';
	f.submit();
}
function deleteButtonClicked(e) {
	var f = e.target.parentNode;
	f.action = 'index.php?section=ville&action=delete';
	f.submit();
}
</script>

<form action="index.php?section=ville&amp;action=add" method="post">
	<fieldset>
	<legend>Ajout :</legend>
		<input type="text" placeholder="nom de la ville" name="nom" id="name"/>
		<input type="submit" value="Ajouter" />
	</fieldset>
</form>
<script type="text/javascript" src="global/ville.js"></script>

</section>