<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="body_admin">

	<?php 
if (isset($_SESSION['verification_page_admin_sous'])) {

	// l'enregistrement de l'administrateur dans la base de donnee
	if (isset($_POST['pass_un']) AND isset($_POST['pass_deux'])) {
		// connection a la base de donnee
		require '../connection/dataConnexion.php';

		// Hachage du mot de passe
		$pass_hache = password_hash($_POST['pass_deux'], PASSWORD_DEFAULT);

		$requete = $connexion->prepare(
		"INSERT INTO admin(pass_un, pass_deux)
			VALUES(:pass_un, :pass_deux)"
		);

		$requete->bindParam(':pass_un', $_POST['pass_un']);
		$requete->bindParam(':pass_deux', $pass_hache);
		$requete->execute();

		// on detruit les donnees apres l'insertion
		unset($_POST['pass_un']);
		unset($_POST['pass_deux']);

		echo 'Administrateur ajouté <br>';
		echo '<a href="../index.php">déconnexion</a>';

		die();
	}

	// la verification de la confirmation du mot de pass
	if (isset($_POST['confirm_pass']) AND $_POST['confirm_pass'] === "daou666") {	
		// on remplit les donnees
	?>
		<p>Ici on ajout un nouveau administrateur qui pourra modifier les donnees dans la base</p>
		<form method="post" action="ajoutAdministrateur.php" enctype="multipart/form-data">
			<label for="pass_un">Mot de passe 1</label><br>
			<input type="text" name="pass_un" id="pass_un" required><br><br>

			<label for="pass_deux">Mot de passe 2( 1 doit etre different de 2)</label><br>
			<input type="text" name="pass_deux" id="pass_deux" required><br><br>

			<input type="submit" value="Valider">
		</form>

	<?php 

	die();
	}

	 ?>

	<form method="post" action="ajoutAdministrateur.php">
		<label for="confirm_pass">Confirmer le mot de passe pour passer à l'ajout</label><br>
		<input type="password" name="confirm_pass" id="confirm_pass"><br><br>

		<input type="submit" value="Valider">
	</form>

<?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>