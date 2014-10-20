<section>
<p>Vos réservations :</p>
<ul>

<?php

foreach ($resas as $resa) {
	echo '<li>';

	$trajet = $this->tm->get($resa->trajet());
	$l = $this->lm->get($trajet->liaison());
	$vd = $this->vm->get($l->villeDepart());
	$va = $this->vm->get($l->villeArrivee());
	$t = $this->trainm->get($trajet->train());

	$duree = (int) ($l->longueur() / $t->vitesse() * 3600);
	$tdepart = new DateTime($trajet->heureDepart(), new DateTimeZone('Europe/Paris'));
	$tarrivee = clone $tdepart;
	$tarrivee->add(new DateInterval('PT'.$duree.'S'));

	echo '<p>'.$vd->nom().' -> '.$va->nom().' ('.$l->longueur().'km)'.'</p>';

	echo '<p>';
	echo $trajet->heureDepart().' -> '.$tarrivee->format('H:i:s').' (durée : '.sec2hms($duree).')';
	echo '</p>';

	echo '<p>Train : '.$t->nbPlaces().'pl. / '.$t->vitesse().'km/h</p>';

	echo '</li>';
}

?>

</ul>
</section>