<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
// connexion a la base de donnee
require '../connection/dataConnexion.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Recherche</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>
<body class="bod_recherche_final">

	<div class="espace_finale"></div>

	<?php 
// la verifation de l'acces a la page
if (isset($_SESSION['verification_page'])) {


	// on recupere les donnees
	$table =  $_SESSION['nom_dossier'];
	$classe = $_SESSION['class'];
	$matiere = $_SESSION['nom_matiere'];

	if (isset($_POST['recherche']) AND !empty($_POST['recherche'])) {
		$_SESSION['recherche_valeur'] = $_POST['recherche'];
	}

	$recherche_valeur = $_SESSION['recherche_valeur'];
	$resul_verify = ""; // pour verifier si le resultat retourné n'est pas vide
	

echo '<div class="liste_document">';

	echo '<div class="container">';

	// si c'est n'est pas le sujet d'examen
	if ($table == 'livres' OR $table == 'brochures') {

		// la requete pour afficher le resultat de la recherche, livre, brochure et sujet devaluation
		$req = $connexion->query("
			SELECT *
			FROM $table
			WHERE MATCH(commentaire) 
			AGAINST('$recherche_valeur*' IN BOOLEAN MODE) AND class='$classe' AND matiere='$matiere' ");

		while ( $result = $req->fetch()) {
		?>
		<div class="box">
			<div class="image_conteneur">
				<p class="commentaire_livr_broch">
					<?php echo $result['commentaire']; ?>
				</p>

				<div class="photo_livr_broch">
					<a href="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['image']; ?>">
						<img src="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['image']; ?>" class='photo_liv_bro'>
					</a>		
				</div>
			</div>

		 	<div class="container_lecture_telechargement">
		 		<div class="div_lecture_telechargement">
		 			<button class="btn btn-outline-primary lecture"><a href="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['nom']; ?>">Ouvrir</a></button>
		 		</div>

				<div class="div_lecture_telechargement">
					<button class="btn btn-outline-success telechargement"><a href="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['nom']; ?>" download>Télécharger</a></button>
				</div>
		 	</div>
			
		</div>

		<?php

		$resul_verify = $result['id'];
		}
	echo '</div>';

	}elseif ($table == 'sujetexamen')
	{
		// la requete pour afficher le resultat de la recherche, livre, brochure et sujet devaluation
		$req = $connexion->query("
			SELECT *
			FROM $table
			WHERE MATCH(annee) 
			AGAINST('$recherche_valeur*' IN BOOLEAN MODE) AND class='$classe' AND matiere='$matiere' ");

		while ( $result = $req->fetch()) {
		?>

		<div class="result_sujetexamen">
			<a href="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['image']; ?>" target="_blank"><?php echo $result['annee']; ?></a>
		</div>

		<?php 
		$resul_verify = $result['id'];
		}

		$req->closeCursor();

	}else //pour le sujet d'evaluation
	{
		// la requete pour afficher le resultat de la recherche, livre, brochure et sujet devaluation
		$req = $connexion->query("
			SELECT *
			FROM $table
			WHERE MATCH(commentaire) 
			AGAINST('$recherche_valeur*' IN BOOLEAN MODE) AND class='$classe' AND matiere='$matiere' ");

		while ($result = $req->fetch()) {
		?>

		<div class="commentaire_sujet_eval">
			<a href="../<?php echo $table; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $result['image']; ?>" target="_blank"><?php echo $result['commentaire']; ?></a>
		</div>

		<?php 
		$resul_verify = $result['id'];
		}
		$req->closeCursor();
	}

	// pour verifier si le resultat retourné n'est pas vide 
	if (empty($resul_verify)) {

		echo '<div class="result_vide">Aucun document trouvé...</div>';
		$resul_verify = "";
	}

	$req->closeCursor();
	 ?>

<?php 
}else{
	header('Location: ../index.php');
}

?>

</div>

</body>
</html>