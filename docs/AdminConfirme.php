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
// pour la verification de l'access a la page
if (isset($_SESSION['verification_page'])) {

	if (isset($_POST['pass_un']) AND isset($_POST['pass_deux'])) {
		// connection a la base de donnee
		require '../connection/dataConnexion.php';

		$code = $_POST['pass_un'];

		// verification si le login et le mot de pass existe dans la base
		$resultat = $connexion->query("SELECT pass_un, pass_deux FROM admin WHERE pass_un = '$code' ");
		$row = $resultat->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass_deux'], $row['pass_deux']);

		if (!empty($row) AND $isPasswordCorrect) {

			// ON CREER UNE VARIABLE POUR LA VERIFICATION DANS LE PAASGE DANS LES PAGES
			$_SESSION['verification_page_admin'] = "verify";

			header('Location: ../admin/administrateur.php');
		}else{
			
			echo 'Mauvais identifiant ou mot de passe !';
		}

		// on detruit les donnees apres l'insertion
		unset($_POST['pass_un']);
		unset($_POST['pass_deux']);
	}

	 ?>

	<form method="post" action="AdminConfirme.php">
		<p>Veuillez confirmer vos données</p>

		<label for="pass_un">Mot de passe 1</label><br>
		<input type="text" name="pass_un" id="pass_un" required><br><br>

		<label for="pass_deux">Mot de passe 2</label><br>
		<input type="password" name="pass_deux" id="pass_deux" required><br><br>

		<input type="submit" value="valider">
	</form>

<?php

}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>