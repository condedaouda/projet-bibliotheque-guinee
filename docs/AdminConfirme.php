<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

	<?php 
// pour la verification de l'access a la page
if (isset($_SESSION['verification_page'])) {

	if (isset($_POST['login']) AND isset($_POST['pass'])) {
		// connection a la base de donnee
		require '../connection/dataConnexion.php';

		$login = $_POST['login'];
		$pass = $_POST['pass'];

		// verification si le login et le mot de pass existe dans la base
		$resultat = $connexion->query("SELECT * FROM admin ");
		
		while ($row = $resultat->fetch()) {
			// Comparaison du pass envoyé via le formulaire avec la base
			$isPasswordCorrect = password_verify($_POST['pass'], $row['pass']);

			if (!empty($row) AND $isPasswordCorrect) {

				// ON CREER UNE VARIABLE POUR LA VERIFICATION DANS LE PAASGE DANS LES PAGES
				$_SESSION['verification_page_admin'] = "verify";

				header('Location: ../daoucondehAdminDocs/accueil.php');
				die();
			}
		}

		// on detruit les donnees apres l'insertion
		unset($_POST['login']);
		unset($_POST['pass']);
	}

	 ?>

	<div class="form_adminconfirm">
		<form method="post" action="AdminConfirme.php">
			<p>Veuillez confirmer vos données</p>

			<label for="pass_un">Login</label><br>
			<input type="text" name="login" class="password_admonconfirm" id="pass_un" required><br><br>

			<label for="pass_deux">Password</label><br>
			<input type="password" name="pass" class="password_admonconfirm" id="pass_deux" required><br>

			<input type="submit" value="valider">
		</form>
	</div>

<?php

}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>