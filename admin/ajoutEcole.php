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
	require '../connection/dataConnexion.php'; //connexion a la base

if (isset($_SESSION['verification_page_admin_sous'])) {

	if (!empty($_POST['code_ecole']) AND !empty($_POST['nom_ecol']) AND isset($_FILES['photo_ecole']['name'])) {

		// la photo, le nom de l'image doit etre le meme que le nom de l'ecole
			$cheminImage = "../photo/" .$_FILES['photo_ecole']['name'];
			$resultaImage = move_uploaded_file($_FILES['photo_ecole']['tmp_name'], $cheminImage);

			// si la photo sera bien donnee
			if ($resultaImage) {
				$requete = $connexion->prepare(
				"INSERT INTO ecoles(code_ecole, nom_ecole, photo)
					VALUES(:code_ecole, :nom_ecole, :photo)"
				);

				$requete->bindParam(':code_ecole', $_POST['code_ecole']);
				$requete->bindParam(':nom_ecole', $_POST['nom_ecol']);
				$requete->bindParam(':photo', $_FILES['photo_ecole']['name']);

				$requete->execute();

				echo "l'école a été ajoutée";
				echo '<br><a href="ajoutEcole.php">ajouter école</a>';
				echo '<br><a href="../index.php">déconnexion</a>';

				die();
			}else
			{
				echo "Erreur de chargement de la photo";
				die();
			}
		}
	 ?>

	<form method="post" action="ajoutEcole.php" enctype="multipart/form-data">

		<div class="form_ajoutEcole">
			<!-- ces 3 champs doivent être obligatoire -->
			<label for="code_ecole">Code de l'ecole</label><br>
			<input type="text" name="code_ecole" id="code_ecole" required autofocus><br><br>

			<label for="nom_ecol">Nom de l'ecole</label><br>
			<input type="text" name="nom_ecol" id="nom_ecol" required><br><br>

			<label for="photo_ecole">Photo de l'école</label><br>
			<input type="file" name="photo_ecole" id="photo_ecole" required><br><br>

			<input type="submit" value="ajouter"><br><br>
		</div>
		
	</form>
	
<?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>