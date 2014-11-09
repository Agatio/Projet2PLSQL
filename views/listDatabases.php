<section>
	<fieldset id="coBDD">
		<legend>Liste des bases de données :</legend>
		<form method="post">
			<select id="database">
				<?php
					foreach ($databases as $d)
					{
						echo '<option value="'.$d->db_id().'"';
						echo '>Nom : '.$d->db_name().'</option>';	
					}
				?>
			</select>
			<label>Login</label>
			<input type="text" id="login" name="login"/>
			<label>Mot de passe</label>
			<input type="password" id="password" name="password"/>
			<label>SID</label>
			<input type="text" id="SID" name="SID"/>
			<input type="button" value="Connexion" onclick="deleteButtonClicked(event)" />
		</form>
	</fieldset>

	<script>
	function modifyButtonClicked(e) {
		var f = e.target.parentNode;
		f.action = 'index.php?section=trajet&action=update';
		f.submit();
	}
	function deleteButtonClicked(e) {
		var f = e.target.parentNode;
		var x = document.getElementById("database").selectedIndex;
		var y = document.getElementById("database").options;
		f.action = 'index.php?section=database&action=show&dbid=' + y[x].value;
		f.submit();
	}
	</script>
</section>