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

	if (isset($_POST['matiere']) AND $_POST['genre'] != "" AND $_POST['classee'] != "") {

		require '../connection/dataConnexion.php'; //connexion a la base

		// l'ajout de la matiere dans la base de donnee
		$requete = $connexion->prepare(
			"INSERT INTO matieres(class, nom_matiere)
				VALUES(:class, :nom_matiere)"
			);

			$requete->bindParam(':class', $_POST['classee']);
			$requete->bindParam(':nom_matiere', $_POST['matiere']);

			$requete->execute();

			$nom_dossier = $_POST['genre'];
			$nom_class = $_POST['classee'];
			$nom_matiere = $_POST['matiere'];

			// la creation du dossier
			//le chemin
			$mypath = "..\\$nom_dossier\\$nom_class\\$nom_matiere";
			if (is_dir($mypath)) {
				echo "Ce fichier existe deja";
			}else
			{
				mkdir($mypath);
				echo "Le répertoire a été cree";
			}

			echo "La matière a été ajoutée";

		?>
		<div >
			<br><br><p><a href="../index.php">Retour</a></p>
		</div>

		<?php

		die();
	}
	 ?>


	<!-- ajouter une matiere dans la base -->
	 <div class="ajouter_matiere">
	 	<form method="post" action="ajouterMatiere.php">
			<label for="matiere">Le nom de la matière</label><br>
			<input type="text" name="matiere" id="matiere" required placeholder="matiere" autofocus><br><br>

		 	<label for="classe" class="class_label">La classe</label><br>
			<select name="classee" id="classe">
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


			<label for="classe">Genre du document</label><br>
			<select name="genre" id="classe">
	           <option value=""></option>
	           <option value="livres">livres</option>
	           <option value="brochures">brochures</option>
	           <option value="sujetExamen">sujet d'examen</option>
	           <option value="sujetEvaluation">sujet d'évaluation</option>
	       </select><br>


			<input type="submit" value="connexion">
		</form>
	 </div>

<?php 
}else{
	header('Location: ../index.php');
}

 ?>

</body>
</html>