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
	<title>Documents</title>
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" type="text/css" href="../css/responsive.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>
<body>

	<?php 

// la verifation de l'acces a la page
if (isset($_SESSION['verification_page'])) {

	// le dossier de stock et la base de donnee ont meme nom
	// si le nom de du dossier existe, on le copie dans la variable globale
	if (isset($_POST['nom_dossier'])) {
		$_SESSION['nom_dossier'] = $_POST['nom_dossier'];
	}

	$data = $chemin =  $_SESSION['nom_dossier'];

	// la class pour le chemin aussi
	$classe = $_SESSION['class'];

	// la matiere
	$matiere = $_SESSION['nom_matiere'];

echo '<div class="wrap_document">';

	// pour bien ecrire le nom si ces le sujet devaluation ou le sujet dexamen
	if ($_SESSION['nom_dossier'] === 'sujetevaluation') {
		// echo '<h4>'. $_SESSION['nom_ecole_session'] .': Sujets d\'évaluation</h4>';
		$val_doc_search = " sujet d'évaluation..."; //pour l'utiliser dans la recherche

	}elseif ($_SESSION['nom_dossier'] === 'sujetexamen') {
		// echo '<h4">'. $_SESSION['nom_ecole_session'] .': Sujets d\'examen</h4>';
		$val_doc_search = " sujet d'examen..."; //pour l'utiliser dans la recherche

	}else{
		// echo '<h4">'. $_SESSION['nom_ecole_session'] .': '.$chemin. '</h4>';
		$val_doc_search = " livre/brochure..."; //pour l'utiliser dans la recherche

	}

	// la recherche du document -->
	require 'recherche.php';

echo '</div>';

	$val_doc_search = ""; //on vide le contenu
echo '<div class="liste_document">';

	echo '<div class="container">';
		// si le dossier nest pas sujetevaluation
		if ($chemin === 'livres' OR $chemin === 'brochures') {
			$resultat = $connexion->query("SELECT * FROM $data WHERE class = '$classe' AND matiere = '$matiere'");
			while ($donnees = $resultat->fetch()) {
			?>

				<div class="box">
					<div class="image_conteneur">

						<form method="POST" action="detail.php">
							<input type="" name="nom_detail" value="<?php echo $donnees['id']; ?>" hidden="name">
							<button type="submit"  class="btn btn-link"><?php echo $donnees['commentaire']; ?></button>
							
							<!-- <p class="commentaire_livr_broch">
								<?php //echo $donnees['commentaire']; ?>				
							</p> -->
						</form>

						<a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>">					
							<img src="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>" class='img-thumbnail photo_liv_bro'>
						</a>
					</div>
					
					<div class="container_lecture_telechargement">
						<div class="div_lecture_telechargement">
							<button class="btn btn-light lecture"><a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['nom']; ?>" >Ouvrir</a></button>
						</div>

						<div class="div_lecture_telechargement"> 
							<button class="btn btn-light telechargement"><a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['nom']; ?>" download>Télécharger</a></button>
						</div>
					</div>


				</div><br>				

			<?php
			}
	
	 	$resultat->closeCursor();

		}elseif ($chemin === 'sujetexamen') {
			
			$resultat = $connexion->query("SELECT * FROM $data WHERE class = '$classe' AND matiere = '$matiere' ORDER BY annee DESC ");
			while ($donnees = $resultat->fetch()) {
			?>
			<div class="annee_sujet">
				<div class="annee_sujets">
					<a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>" ><?php echo $donnees['annee']; ?></a>
				</div>
			</div>
		<?php 
			}
				$resultat->closeCursor();

		}else{
				echo "Pas de fichier";
			}

		}else{
			header('Location: ../index.php');
		}
			?>
	</div>

</div>

</body>
</html>
