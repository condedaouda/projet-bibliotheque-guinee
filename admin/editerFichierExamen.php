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

	 if (isset($_POST['id_editerFichierExamen'])) {
	 	$_SESSION['id_editerFichierExamen'] = $_POST['id_editerFichierExamen'];
	 }

	 $id_editerFichierExamen = $_SESSION['id_editerFichierExamen'];
	 $nom_table = $_SESSION['nom_table_examen'];

	 // on secupere les donnees dans la base de donnee pour l'utiliser dans le formulaire
	 $req = $connexion->prepare("SELECT annee FROM $nom_table WHERE id = ?");
	 $req->execute(array($id_editerFichierExamen));
	 $result = $req->fetch();


	 // la modification du fichier
	 if (isset($_POST['annee']) AND !empty($_POST['annee'])) {

	 	$modification = $connexion->prepare("UPDATE $nom_table 
		SET annee = :annee
			
		WHERE id = :id");

		$modification->execute(array(
			'annee' => $_POST['annee'],
			'id' => $id_editerFichierExamen
		));

		echo 'Annee a été modifier'. '<br>';
		echo '<a href="../index.php">Retour</a><br><br>';

		die();
	 }
	 ?>

	<form method="post" action="editerFichierExamen.php" enctype="multipart/form-data">
		<label for="commentaire">Modifier annee</label><br>
		<input type="text" name="annee" id="annee" value="<?php echo $result['annee'] ; ?>"><br>

		<input type="submit" value="Modifier">
	</form>

<?php 
}else{
	header('Location: ../index.php');
}
?>

</body>
</html>