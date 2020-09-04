<?php 
session_start();
// connection a la base de donnee
require '../connection/dataConnexion.php';

if (isset($_SESSION['verification_page_admin_sous'])) {

	// on affecte les valeures pour preparer la supression
	$nom_table = $_SESSION['nom_table_examen'];
	$nom_class_supp = $_SESSION['nom_class_supp_examen'];
	$nom_matiere_supp = $_SESSION['nom_matiere_supp_examen'];
	$nom_annee_supp = $_SESSION['nom_annee_supp_examen'];
	$image_examen_supp = $_SESSION['image_examen_supp']; 

	// on recupere l'id du sujet
	if (isset($_POST['id_supprimerDocus'])) {
		$id_supprimerDocus = $_POST['id_supprimerDocus'];
	}

	// la requette
	$req = $connexion->prepare("DELETE FROM $nom_table  WHERE id = ?");
	$req->execute(array($id_supprimerDocus));
		
		// la suppression dans le serveur
		unlink ("../$nom_table/$nom_class_supp/$nom_matiere_supp/$image_examen_supp");

		// la suppression des cookies
		session_destroy();

		echo "Le fichier a été supprimer <br><br>";
		echo '<a href="../index.php">Retour</a>';


	// on supprime les fichiers avec leur clé primaire dans a base de donnee

}else{
	header('Location: ../index.php');
}


 ?>