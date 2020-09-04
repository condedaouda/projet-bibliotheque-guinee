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
	if (isset($_POST['pass_un'])) {
		// connection a la base de donnee
		require '../connection/dataConnexion.php';

		$password = $_POST['pass_un'];

		// la suppression dans la base de donnee
		$req = $connexion->prepare("DELETE FROM admin  WHERE pass_un = ?");
		$req->execute(array($password));

		// on detruit les donnees apres l'insertion
		unset($_POST['pass_un']);

		echo 'Administrateur supprimé <br>';
		echo '<a href="../index.php">déconnexion</a>';

		die();
	}

	// la verification de la confirmation du mot de pass
	if (isset($_POST['confirm_pass']) AND $_POST['confirm_pass'] === "daou666") {	
		// on remplit les donnees
	?>
		<form method="post" action="supprimerAdmin.php">
			<label for="pass_un">passe 1 de l'administrateur à supprimer</label><br>
			<input type="text" name="pass_un" id="pass_un" required><br><br>

			<input type="submit" value="Valider">
		</form>

	<?php 

	die();
	}

	 ?>

	<form method="post" action="supprimerAdmin.php">
		<label for="confirm_pass">Confirmer le mot de passe pour la suppresion</label><br>
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