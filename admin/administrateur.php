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
if (isset($_SESSION['verification_page_admin'])) {

	$_SESSION['verification_page_admin_sous'] = "verify";

	 ?>

	<!-- cest 2 liens doivent etre dans un dossiers a part ou je serai le seul a eu acceder pour ajouter des fichiers et des ecoles -->
	<div class="ajouts">
		<p><a href="ajoutfichier.php">Ajouter un document</a></p>
		<p><a href="ajoutEcole.php">Ajouter une école</a></p>
		<p><a href="modifierEcoleNomCode.php">Modifier le code ou nom de l'école</a></p>
		<p><a href="modifierEcolePhoto.php">Changer la photo de l'école</a></p>
	 	<p><a href="modifierEcoleSlogant.php">Modifier le slogant de l'école</a></p>
	 	<p><a href="modifierFichier.php">Modifier les documents livres, brochures et sujet d'évaluation</a></p>
	 	<p><a href="modifierExamen.php">Modifier le sujet d'examen</a></p>
	 	<p><a href="ajouterMatiere.php">Ajouter une matière</a></p>
	 	<p><a href="SupprimerMatiere.php">Supprimer une matière</a></p>
	 	<p><a href="ajoutAdministrateur.php">Ajouter administrateur</a></p>
	 	<p><a href="supprimerAdmin.php">Supprimer administrateur</a></p>

	</div>

<?php 
}else{
	header('Location: ../index.php');
}
?>

</body>
</html>