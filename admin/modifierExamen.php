<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

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

	// connexion a la base de donnee
	require '../connection/dataConnexion.php'; //connexion a la base

	if (isset($_POST['nom_table']) AND !empty($_POST['nom_table']) AND isset($_POST['nom_class']) AND !empty($_POST['nom_class']) AND isset($_POST['nom_matiere']) AND !empty($_POST['nom_matiere']) AND isset($_POST['annee']) AND !empty($_POST['annee'])) {

		// on affecte les valeures
		$nom_table = $_SESSION['nom_table_examen'] = $_POST['nom_table'];
		$nom_class = $_SESSION['nom_class_supp_examen'] = $_POST['nom_class'];
		$nom_matiere = $_SESSION['nom_matiere_supp_examen'] = $_POST['nom_matiere'];
		$nom_annee = $_SESSION['nom_annee_supp_examen'] = $_POST['annee'];

		// la requette
		$req = $connexion->prepare("SELECT *FROM $nom_table WHERE class= ? AND matiere= ? AND annee= ? ");
		$req->execute(array(
			$_POST['nom_class'], 
			$_POST['nom_matiere'],
			$nom_annee
		));

		// on affiche une seule ligne.
		$result = $req->fetch();

		// on recupere le nom de l'image dans la base pour la suppression
		$_SESSION['image_examen_supp'] = $result['image'];

		// si le fichier existe dans la base
		if (!empty($result)) {
			
			echo 'numéro: '. $result['id']. ' matiére: '.$result['matiere']. ', classe: ' . $result['class'] . ', annee: ' . $result['annee']. '<br>';

			$classe = $result['class'];
			$matiere = $result['matiere'];
			
			?>

			<!-- pour modifier l'annee du sjet d'examen -->
			<br><form method="post" action="editerFichierExamen.php">
				<input type="text" name="id_editerFichierExamen" value="<?php echo $result['id'] ?>" hidden>
				<input type="submit" value="editer">
			</form><br>

			<!-- pour la suppression du document -->
			<form method="post" action="supprimerExamen.php">
				<input type="text" name="id_supprimerDocus" value="<?php echo $result['id'] ?>" hidden>
				<input type="submit" value="supprimer">
			</form> <br>

			<?php
			

			die();
			}else
			{
				echo "Ce sujet n'existe pas.";
				die();
			}

	}

	 ?>


	<p class="anoter_bien">Ici vous pouvez modifier les sujets d'examens</p>
	<form method="post" action="modifierExamen.php">

		<label for="nom_table">Entrer le nom du document(sujetexamen)</label><br>
 		<input type="text" name="nom_table" required autofocus><br><br>

 		<label for="nom_class">Entrer la classe(10 et terminales)</label><br>
 		<input type="text" name="nom_class" required><br><br>

 		<label for="nom_matiere">Entrer le nom de la matière</label><br>
 		<input type="text" name="nom_matiere" required><br><br>

 		<label for="annee">Entrer l'année du sujet d'examen</label><br>
 		<input type="text" name="annee" required><br><br>

 		<input type="submit" name="Ouvrir">
 	</form>

   <?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>