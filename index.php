<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require './connection/dataConnexion.php'; //connexion a la base
$_SESSION['classe_valeur'] = '';
$_SESSION['verifyCookie'] = false;


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Connection</title>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="css/style1.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="photo/icon.png"/>
</head>
<body class="index_body">

<?php 

	if (isset($_POST['nom']) AND !empty($_POST['nom'])) {

		$nom = $_POST['nom'];
		$password = $_POST['pass'];


		// verification si le login et le mot de pass existe dans la base
		$resultat = $connexion->query("SELECT *FROM ecoles WHERE nom_ecole = '$nom' AND code_ecole = '$password' ");
		$row = $resultat->fetch();

		if (!empty($row)) {

			// ON CREER UNE VARIABLE POUR LA VERIFICATION DANS LES PAGES
			$_SESSION['verification_page'] = "verify";

			// pour recuperer le nom de lecole
			$_SESSION['nom_ecole_session'] = $row['nom_ecole'];

			// pour recuperer le code de lecole
			$_SESSION['code_ecole_session'] = $row['code_ecole'];

			// pour recuperer le nom de la photo de l'ecole
			$_SESSION['nom_photo_ecole'] = $row['photo'];

			// pour recuperer le slogant de l'ecole
			$_SESSION['slogant_ecole'] = $row['slogant'];

			// la verification si c'est l'administrateur qui se connecte
			if ($row['code_ecole'] === 'adminconde666' and $row['nom_ecole'] === 'admin') {
				// on lui redirige sur cette page pour la validation
				header('Location: ./docs/AdminConfirme.php');
			}else{

				$_SESSION['verifyCookie'] = false;
				//la creation du cookies
				$valNomCooki = $row['nom_ecole'];
				$valCodeCookie = $row['code_ecole'];

				// cookies pour une semaine
				setcookie('nom', $valNomCooki, time() + 604800, null, null, false, true);
				setcookie('code', $valCodeCookie, time() + 604800, null, null, false, true);
				//la redirection
				header('Location: docs/classe.php');
				die();
			}
		}

	} 
	 
	?>

<div class ="wrap_class">
	<h2>Connectez vous</h2>
	<form method="post" action="index.php">
		<input type="text" name="nom" id="code" required placeholder="nom de l'école" autofocus><br>
		<input type="password" name="pass" id="pass" required placeholder="mot de passe"><br>
		<div class='cookiEcole'>
			<?php cookies() ?>
		</div>
		<input type="submit" value="connexion" class="">
	</form>
</div>

<?php

	//la fonction pour appeler le nom de l'université avec les cookies
	function cookies()
	{
		if (isset($_COOKIE['nom']) and isset($_COOKIE['code'])) {
			$_SESSION['verifyCookie'] = true;

			$_SESSION['nom_ecole_session'] = $_COOKIE['nom'];
			$_SESSION['code_ecole_session'] = $_COOKIE['code'];

?>
				<a href="./docs/classe.php"><?php echo $_SESSION['nom_ecole_session'] ?></a>
<?php
				
			
		}
	}

?>

<script src="js/index.js"></script>

</body>
</html>