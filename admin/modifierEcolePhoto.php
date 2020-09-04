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
	<!-- NB: l'image qui doit être modifier doit etre le meme nom que la nouvelle image -->

	<?php
if (isset($_SESSION['verification_page_admin_sous'])) {

	require '../connection/dataConnexion.php'; //connexion a la base

	if (!empty($_POST['code_ecole']) AND isset($_POST['code_ecole']) AND !empty($_FILES['photo']['name'])) {

		$req = $connexion->prepare("SELECT *FROM ecoles WHERE code_ecole = ?");
		$req->execute(array($_POST['code_ecole']));
		$result = $req->fetch();


		// on verify si le code existe vraiment 
		if (!empty($result)) {

			// la photo, le nom de l'imae doit etre le meme que le nom de l'ecole
			$cheminImage = "../photo/" .$_FILES['photo']['name'];
			$resultaImage = move_uploaded_file($_FILES['photo']['tmp_name'], $cheminImage);

			// si la mise a jour de l'ecole est faite, on modifit les donnees
			if ($resultaImage) {
				$modification = $connexion->prepare("UPDATE ecoles 
				SET photo = :photo
					
				WHERE code_ecole = :code_ecole");

				$modification->execute(array(
					'photo' => $_FILES['photo']['name'],

					'code_ecole' => $_POST['code_ecole']
				));

				echo "mise a jour éffectuer";
				echo '<br><a href="../index.php">déconnexion</a>';
				
				die();
			}else
			{
				echo "L'image n'a pas été enregistrer sur le serveur";
			}
			die();
		}else
		{
			echo "Ce code n'existe pas dans la base";
			die();
		}
	}

	 ?>


	<!-- on entre le code de l'école -->
	<form method="post" action="modifierEcolePhoto.php" enctype="multipart/form-data">

		<div class="form_modifEcolPhoto">
			<label for="code_ecole">Le code de l'école</label><br>
			<input type="text" name="code_ecole" id="code_ecole" required autofocus><br><br>

			<label for="photo">Ajouter la photo</label><br>
			<input type="file" name="photo" id="photo" required><br><br>

			<input type="submit" name="Changer">
		</div>
		
	</form>

 <?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>