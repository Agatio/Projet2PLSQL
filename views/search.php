<section>

<form action="index.php?section=reservation&amp;action=search" method="post">
	<label>Départ : </label>
	<?php
	echo '<select name="villeDepart">';
	foreach ($villes as $v) {
		echo '<option value="'.$v->id().'"';
		if (isset($_POST['villeDepart']) && $v->id() == $_POST['villeDepart'])
		{
			echo ' selected="selected"';
		}
		echo '>'.$v->nom().'</option>';
	}
	echo '</select>';
	?>
	<label>Arrivée : </label>
	<?php
	echo '<select name="villeArrivee">';
	foreach ($villes as $v) {
		if(!($v==$villes[0] && !isset($_POST['villeArrivee'])))
		{
			echo '<option value="'.$v->id().'"';
			if (isset($_POST['villeArrivee']) && $v->id() == $_POST['villeArrivee'])
			{
				echo ' selected="selected"';
			}
			echo '>'.$v->nom().'</option>';
		}
	}
	echo '</select>';
	foreach($villes as $v)
	{
		if (isset($_POST['villeDepart']) && $v->id() == $_POST['villeDepart'])
		{
			echo '<input type="hidden" value="' . $v->lat() . '" name="latD" id="latD" />';
			echo '<input type="hidden" value="' . $v->lng() . '" name="lngD" id="lngD" />';
		}
	}
	foreach($villes as $v)
	{
		if (isset($_POST['villeArrivee']) && $v->id() == $_POST['villeArrivee'])
		{
			echo '<input type="hidden" value="' . $v->lat() . '" name="latA" id="latA" />';
			echo '<input type="hidden" value="' . $v->lng() . '" name="lngA" id="lngA" />';
		}
	}
	
	
	?>

	<input type="submit" value="Rechercher" id="sub"/>
</form>

</section>