<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();

// connexion a la base de donnee
require '../connection/dataConnexion.php'; //connexion a la base

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bod_modifEcolNomCode">
	<?php

if (isset($_SESSION['verification_page_admin_sous'])) {

	if (isset($_POST['code_ecole']) AND isset($_POST['nom_ecolee'])) {

		$modification = $connexion->prepare("UPDATE ecoles 
		SET code_ecole = :code_ecole,
			nom_ecole = :nom_ecole
			
		WHERE id = :id");

			$modification->execute(array(
				'code_ecole' => $_POST['code_ecole'],
				'nom_ecole' => $_POST['nom_ecolee'],

				'id' => $_SESSION['id']
			));

			echo "mise a jour éffectuer<br>";
			echo '<a href="../index.php">Retour</a>';
	}

}else{
	header('Location: ../index.php');
}

?>

</body>
</html>
