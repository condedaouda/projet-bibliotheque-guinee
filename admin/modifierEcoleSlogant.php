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

	require '../connection/dataConnexion.php'; //connexion a la base

	if (!empty($_POST['code_ecole']) AND isset($_POST['code_ecole']) AND !empty($_POST['slogant'])) {

		$req = $connexion->prepare("SELECT *FROM ecoles WHERE code_ecole = ?");
		$req->execute(array($_POST['code_ecole']));
		$result = $req->fetch();


		// on verify si le code existe vraiment 
		if (!empty($result)) {

			$modification = $connexion->prepare("UPDATE ecoles 
			SET slogant = :slogant
				
			WHERE code_ecole = :code_ecole");

			$modification->execute(array(
				'slogant' => $_POST['slogant'],
				'code_ecole' => $_POST['code_ecole']
			));
			echo "mise a jour effectuer";
			echo '<br><a href="../index.php">déconnexion</a>';
			die();

			die();
		}else
		{
			echo "Ce code n'existe pas dans la base";
			die();
		}
	}

	 ?>


	<!-- on entre le code de l'école -->
	<form method="post" action="modifierEcoleSlogant.php">
		<label for="code_ecole">le code de l'école</label><br>
		<input type="text" name="code_ecole" id="code_ecole" required autofocus><br><br>

		<label for="slogant">Ajouter le slogant de l'ecole</label><br>
		<textarea name="slogant" id="slogant" required></textarea><br><br>

		<input type="submit" name="Changer">
		
	</form>

 <?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>