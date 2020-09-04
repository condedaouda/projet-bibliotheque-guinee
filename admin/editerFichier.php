<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();

// connection a la base de donnee
require '../connection/dataConnexion.php';
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

	 if (isset($_POST['id_editerDocus'])) {
	 	$_SESSION['id_editerDocuss'] = $_POST['id_editerDocus'];
	 }
	 $id_editerDocuss = $_SESSION['id_editerDocuss'];
	 $nom_table = $_SESSION['nom_table'];

	 // on secupere les donnees dans la base de donnee
	 $req = $connexion->prepare("SELECT commentaire FROM $nom_table WHERE id = ?");
	 $req->execute(array($id_editerDocuss));
	 $result = $req->fetch();


	 // la modification du fichier
	 if (isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {

	 	$modification = $connexion->prepare("UPDATE $nom_table 
		SET commentaire = :commentaire
			
		WHERE id = :id");

		$modification->execute(array(
			'commentaire' => $_POST['commentaire'],
			'id' => $id_editerDocuss
		));

		echo 'Le commentaire a été modifier'. '<br>';
		echo '<a href="../index.php">Retour</a><br><br>';

		die();
	 }
	 ?>

	<form method="post" action="editerFichier.php" enctype="multipart/form-data">
		<label for="commentaire">Modifier le commentaire</label><br>
		<input type="text" name="commentaire" id="commentaire" value="<?php echo $result['commentaire'] ; ?>"><br>

		<input type="submit" value="Modifier">
	</form>

<?php 
}else{
	header('Location: ../index.php');
}
?>

</body>
</html>