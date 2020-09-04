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

	if (isset($_POST['nom_data']) AND !empty($_POST['nom_data']) AND isset($_POST['nom_class']) AND !empty($_POST['nom_class']) AND isset($_POST['nom_matiere']) AND !empty($_POST['nom_matiere']) AND isset($_POST['image_fichier']) AND !empty($_POST['image_fichier'])) {

		// on affecte les valeures
		$nom_table = $_SESSION['nom_table'] = $_POST['nom_data'];
		$nom_class = $_SESSION['nom_class_supp'] = $_POST['nom_class'];
		$nom_matiere = $_SESSION['nom_matiere_supp'] = $_POST['nom_matiere'];
		$nom_fichier = $_POST['image_fichier'];

		// la requette
		$req = $connexion->prepare("SELECT *FROM $nom_table WHERE class = ? AND matiere = ? AND image = ?");
		$req->execute(array(
			$_POST['nom_class'], 
			$_POST['nom_matiere'],
			$_POST['image_fichier']
		));

		// on affiche une seule ligne.
		$result = $req->fetch();
		if (!empty($result)) {
			
			echo 'numéro: '. $result['id']. ', nom fichier: ' . $result['image'] . ', classe: ' . $result['class'] . ', commentaire: ' . $result['commentaire']. '<br>';

			// si c'est uniquement le livre ou la brochure
			if (isset($result['nom']) AND !empty($result['nom'])) {
				$_SESSION['nom_fichier_supp'] = $result['nom'];
			}

			$_SESSION['image_fichier_supp'] = $result['image'];
			$classe = $result['class'];
			$matiere = $result['matiere'];
			$_SESSION['commentaire-edite'] = $result['commentaire'];
			?>

			<!-- l'image du fichier -->
			<!-- le chemin dacces du dossier jusqua la class -->
	 		<img src="../<?php echo $nom_table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['image']; ?>" class='photo'><br>
	 		<?php
			// si le fichier existe, on le supprime
			if (!empty($result['id'])) {
			?>

			<!-- pour la suppression du document -->
			<form method="post" action="supprimerDocus.php">
				<input type="text" name="supprimerDocus" value="<?php echo $result['id'] ?>" hidden>
				<input type="submit" value="supprimer">
			</form> <br>

			<!-- pour modifier le commentaire du fichier -->
			<form method="post" action="editerFichier.php">
				<input type="text" name="id_editerDocus" value="<?php echo $result['id'] ?>" hidden>
				<input type="submit" value="editer">
			</form>

			<?php
			}else
			{
				echo "Ce fichier n'existe pas.";
			}

			die();
			}

	}

	 ?>


	<p class="anoter_bien">Ici vous pouvez modifier les livres, brochures et les sujets d'evaluations</p>
	<form method="post" action="modifierFichier.php">

		<label for="nom_data">Entrer le nom du document(tables: le livres, brochures et sujetevaluation)</label><br>
 		<select name="nom_data" id="classe">
           <option value=""></option>
           <option value="livres">livres</option>
           <option value="brochures">brochures</option>
           <option value="sujetExamen">sujet d'examen</option>
           <option value="sujetEvaluation">sujet d'évaluation</option>
	    </select><br>

 		<label for="nom_class">Entrer la classe</label><br>
 		<select name="nom_class" id="classe">
				<option value=""></option>
	           <option value="7">7</option>
	           <option value="8">8</option>
	           <option value="9">9</option>
	           <option value="10">10</option>
	           <option value="11 SM">11 SM</option>
	           <option value="11 SS">11 SS</option>
	           <option value="11 SE">11 SE</option>
	           <option value="12 SS">12 SS</option>
	           <option value="12 SM">12 SM</option>
	           <option value="12 SE">12 SE</option>
	           <option value="Terminale SM">Terminale SM</option>
	           <option value="Terminale SS">Terminale SS</option>
	           <option value="Terminale SE">Terminale SE</option>
	       </select><br><br>

 		<label for="nom_matiere">Entrer le nom de la matière </label><br>
 		<input type="text" name="nom_matiere" required><br><br>

 		<label for="image_fichier">Entrer le nom de l'image du fichier dans la base<br>(pour le connaitre vous pouvez ouvrir le fichier sur le navigateur)</label><br>
 		<input type="text" name="image_fichier" required><br><br>

 		<input type="submit" name="Ouvrir">
 	</form>

  <?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>