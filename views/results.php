<section onload="initialize()">
<style>
      #map_canvas {
        width: 500px;
        height: 400px;
		margin : auto;
		padding-top; 50px;
		padding-bottom: 50px;
		margin-bottom: 30px;
      }
</style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      var directionsDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;

      function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var chicago = new google.maps.LatLng(41.850033, -87.6500523);
        var mapOptions = {
          zoom:7,
          center: chicago
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        var request = {
            origin:new google.maps.LatLng(document.getElementById("latD").value, document.getElementById("lngD").value),
            destination:new google.maps.LatLng(document.getElementById("latA").value, document.getElementById("lngA").value),
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
        directionsDisplay.setMap(map);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<p>Résultats de la recherche :</p>
<ul>

<?php

foreach ($results as $trajet) {
	echo '<li>';

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

	echo '<a href="index.php?section=reservation&action=make&trajet='.$trajet->id().'">Réserver</a>';

	echo '</li>';
}

?>

</ul>


 <div id="map_canvas"></div>
</section>