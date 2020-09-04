<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
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
<body class="body_admin">

	<?php
if (isset($_SESSION['verification_page_admin_sous'])) {

	if (isset($_POST['matiere']) AND $_POST['matiere'] != '' AND $_POST['genre'] != ""  AND $_POST['class'] != "" AND !empty($_FILES['image']['name'])) {

		// le 1er dossier et la base de donnee ont le meme nom
		$data = $chemin = $_POST['genre'];
		$class = $_POST['class'];
		$matiere = $_POST['matiere'];

		// si cest pas le sujet devaluation
		if ($_POST['genre'] === 'livres' OR $_POST['genre'] === 'brochures') {
			$cheminImage = "../$chemin/$class/$matiere/" .$_FILES['image']['name'];
			$cheminLivre = "../$chemin/$class/$matiere/" .$_FILES['livre']['name'];

			$resultaImage = move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);
			$resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

			if ($resultaImage AND $resultaLivre) {
				$requete = $connexion->prepare(
				"INSERT INTO $data(nom, class, matiere, image, commentaire)
				VALUES(:nom, :class, :matiere, :image, :commentaire)"
				);

				$requete->bindParam(':nom', $_FILES['livre']['name']);
				$requete->bindParam(':class', $_POST['class']);
				$requete->bindParam(':matiere', $_POST['matiere']);
				$requete->bindParam(':image', $_FILES['image']['name']);
				$requete->bindParam(':commentaire', $_POST['commentaire']);

				$requete->execute();
			
			}

			$_POST['matiere'] = '';
			echo "enregistrer";
			echo '<br><a href="ajoutfichier.php">retour ajout fichier</a>';
			echo '<br><a href="../index.php">deconnexion</a>';

		}elseif ($_POST['genre'] === 'sujetexamen') { //si cest le sujet dexamen
			$cheminImage = "../$chemin/$class/$matiere/" .$_FILES['image']['name'];
			$resultaImage = move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);

			if ($resultaImage) {
				$requete = $connexion->prepare(
				"INSERT INTO $data(image, class, matiere, annee)
				VALUES(:image, :class, :matiere, :annee)"
				);

				$requete->bindParam(':image', $_FILES['image']['name']);
				$requete->bindParam(':class', $_POST['class']);
				$requete->bindParam(':matiere', $_POST['matiere']);
				$requete->bindParam(':annee', $_POST['annee']);

				$requete->execute();
			
			}

			$_POST['matiere'] = '';
			echo "enregistrer";
			echo '<br><a href="ajoutfichier.php">retour ajout fichier</a>';
			echo '<br><a href="../index.php">deconnexion</a>';

		}elseif($_POST['genre'] === 'sujetevaluation') //si cest le sujet devaluation
		{
			$cheminImage = "../$chemin/$class/$matiere/" .$_FILES['image']['name'];
			$resultaImage = move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);

			if ($resultaImage) {
				$requete = $connexion->prepare(
				"INSERT INTO $data(image, class, matiere, commentaire)
				VALUES(:image, :class, :matiere, :commentaire)"
				);

				$requete->bindParam(':image', $_FILES['image']['name']);
				$requete->bindParam(':class', $_POST['class']);
				$requete->bindParam(':matiere', $_POST['matiere']);
				$requete->bindParam(':commentaire', $_POST['commentaire']);

				$requete->execute();
			
			}

			$_POST['matiere'] = '';
			echo "enregistrer";
			echo '<br><a href="ajoutfichier.php">retour ajout fichier</a>';
			echo '<br><a href="../index.php">deconnexion</a>';

		}else{
			echo "le genre du livre non connu";
			echo '<br><a href="ajoutfichier.php">retour ajout fichier</a>';
			echo '<br><a href="../index.php">deconnexion</a>';
		}

		die();
		
	}

	 ?>

	<form method="post" action="ajoutfichier.php" enctype="multipart/form-data">

		<div class="form_ajout_fichier">
			
			<!-- le nom du genre doit etre au pluriel -->
			<label for="classe">Genre du dossier</label><br>
			<select name="genre" id="classe">
	           <option value=""></option>
	           <option value="livres">livres</option>
	           <option value="brochures">brochures</option>
	           <option value="sujetExamen">sujet d'examen</option>
	           <option value="sujetEvaluation">sujet d'évaluation</option>
	       </select><br><br>


			<label for="classe" class="class_label">La classe</label><br>
			<select name="class" id="classe">
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


	       <!-- la matiere -->
			<label for="matiere">Matiere(le nom de la matièere doit être éxactement que celui dans la base de donnee)</label><br>
			<input type="text" name="matiere" id="matiere" required placeholder="maths, physique..."><br>


			<label for="commentaire">Commentaire</label><br>
			<input type="text" name="commentaire" id="commentaire" placeholder="nom du livre ou autre comment"><br>

			<label for="image">Image du livre(image de couverture)</label><br>
			<input type="file" name="image" id="image" required ><br>

			<label for="livre">Livre(fichier en pdf)</label><br>
			<input type="file" name="livre" id="livre" ><br><br>

			<label for="annee">Annee si c'est un sujet</label><br>
			<input type="text" name="annee" id="annee" placeholder="annee du sujet"><br><br>


			<input type="submit" value="enregistrer">
		</div>
		

	</form>

<?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>