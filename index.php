<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require 'connection/dataConnexion.php'; //connexion a la base
$_SESSION['classe_valeur'] = '';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Connection</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="photo/icon.png"/>
</head>
<body class="body_principale">

<?php 

	if (isset($_POST['code']) AND !empty($_POST['code'])) {

		$code = $_POST['code'];

		// verification si le login et le mot de pass existe dans la base
		$resultat = $connexion->query("SELECT code_ecole, nom_ecole, photo, slogant FROM ecoles WHERE code_ecole = '$code' ");
		$row = $resultat->fetch();

		if (!empty($row)) {

			// ON CREER UNE VARIABLE POUR LA VERIFICATION DANS LE PAASGE DANS LES PAGES
			$_SESSION['verification_page'] = "verify";

			// pour recuperer le nom de lecole
			$_SESSION['nom_ecole_session'] = $row['nom_ecole'];

			// pour recuperer le nom de la photo de l'ecole
			$_SESSION['nom_photo_ecole'] = $row['photo'];

			// pour recuperer le slogant de l'ecole
			$_SESSION['slogant_ecole'] = $row['slogant'];

			// la verification si c'est l'administrateur qui se connecte
			if ($row['code_ecole'] === 'adminconde666') {
				// on lui redirige sur cette page pour la validation
				header('Location: docs/AdminConfirme.php');
			}else{
				//la redirection
				header('Location: docs/classe.php');
			}
		}else{
			// si le code est incorrect
			$code_alerte = "code incorrect";
		}

	 } ?>

	<div class="bienvenue_index">
		<p>Votre bibliothèque numérique</p>
	</div>

	<div class="button_retour_affich">
		<img src="photo/livre.gif">
	</div>
	

	 <div class ="code_ecole">
	 	<form method="post" action="index.php">
			<label for="code">Code de l'école</label><br>
			<input type="text" name="code" id="code" required placeholder="code" autofocus><br>
			<p class="code_alerte">
			<?php if (isset($code_alerte)) {
				echo $code_alerte;
				unset($code_alerte);
			} ?></p>
			<input type="submit" value="connexion" class="principal_button">
		</form>
	 </div>

</body>
</html>