<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../connection/dataConnexion.php'; //connexion a la 

//pour recuperer les donnees de l'ecole venant du cookie
if ($_SESSION['verifyCookie']) {

	$nom = $_SESSION['nom_ecole_session'];
	$password = $_SESSION['code_ecole_session'];
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
	}
}

$nom_ecole = $_SESSION['nom_ecole_session'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" type="text/css" href="../css/responsive.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>

<body>
	<style>

		div#content_body {
			position: absolute;
			width : 100%;
			min-height: 100vh;
			background-image: url('../photo/<?php echo $_SESSION['nom_photo_ecole'] ?>');
			background-color: rgba(100, 100, 100, 0.5);
			background-blend-mode: lighten;
			background-size : cover;
			background-attachment: fixed;
			/* You may add things like width, height, background-size... */
		}

	</style>

<div id="content_body">

	<?php 

// la verifation de l'acces a la page
if (isset($_SESSION['verification_page'])) {

	 ?>

	<div class="wrap">
		<?php echo '<h5>'. $nom_ecole .'</h5> '?>

		<a href="../photo/<?php echo $_SESSION['nom_photo_ecole'] ?>"><img src="../photo/<?php echo $_SESSION['nom_photo_ecole'] ?> " class="img-thumbnail photo_ecole"></a><br><br>

		<form method="post" action="matieres.php" class="forme_classe">
			<label for="classe">Classe</label><br>
			<select name="classe" id="classe">
				<option value="Terminale SM">Terminale SM</option>
				<option value="Terminale SS">Terminale SS</option>
				<option value="Terminale SE">Terminale SE</option>
			</select><br>

		<input type="submit" value="valider">	 	
		</form>
	</div>
	 
<?php 
}else{
	header('Location: ../index.php');
}


function cookies($nom, $password)
{
	
}

?>

</div>

</body>
</html>