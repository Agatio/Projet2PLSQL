<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>
	<body>
		<fieldset>
			<legend>Connexion</legend>
			<form method="POST" action="index.php?section=user&amp;action=connect">
				<table>
					<tr>
						<td>Nom d'utilisateur</td>
						<td><input type="text" name="username"><br/></td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="passwd"><br/></td>
					</tr>
				</table><br/>
				<input type="submit">
			</form>
		</fieldset>
	</body>
</html>