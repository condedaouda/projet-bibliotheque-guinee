<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
// connection a la base de donnee
require '../connection/dataConnexion.php';

if (isset($_SESSION['verification_page_admin_sous'])) {

	// on affecte les valeures pour preparer la supression
	$nom_table = $_SESSION['nom_table'];
	$nom_class_supp = $_SESSION['nom_class_supp'];
	$nom_matiere_supp = $_SESSION['nom_matiere_supp'];
	$image_fichier_supp = $_SESSION['image_fichier_supp'];

	if (isset($_POST['supprimerDocus'])) {
		$supprimerDocus = $_POST['supprimerDocus'];
	}

	// la requette
	$req = $connexion->prepare("DELETE FROM $nom_table  WHERE id = ?");
	$req->execute(array($supprimerDocus));

	// on recupere le nom de l'image et le nom du fichier pdf pour les supprimer aussi dans le serveur apres la suppression dans la base de donnee

		unlink ("../$nom_table/$nom_class_supp/$nom_matiere_supp/$image_fichier_supp");


		if (isset($_SESSION['nom_fichier_supp']) AND !empty($_SESSION['nom_fichier_supp'])) {
			$nom_fichier_supp = $_SESSION['nom_fichier_supp'];

			// la suppression
			unlink ("../$nom_table/$nom_class_supp/$nom_matiere_supp/$nom_fichier_supp");
		}

		session_destroy();


		echo "Le fichier a été supprimer <br><br>";

		echo '<a href="../principal.php">Retour</a>';


	// on supprime les fichiers avec leur clé primaire dans a base de donnee

}else{
	header('Location: ../index.php');
}

 ?>