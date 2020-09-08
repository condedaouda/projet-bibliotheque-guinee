<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../connection/dataConnexion.php'; //connexion a la base

// si le nom de la matiere existe, on le copie dans la variable globale
if (isset($_POST['nom_matiere'])) {
	$_SESSION['nom_matiere'] = $_POST['nom_matiere'];
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dossiers</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>
<body class='bod_dossier'>
	<style>
		div#content_body {
			position: absolute;
			width : 100%;
			height: 100%;
			background-image: url('../photo/<?php echo $_SESSION['nom_photo_ecole'] ?>');
			background-color: rgba(100, 100, 100, 0.5);
			background-blend-mode: lighten;
			background-size : cover;
			background-attachment: fixed;
			/* You may add things like width, height, background-size... */
		}
	</style>

<div id="content_body">

	<?php 
// la verifation de l'acces a la page
if (isset($_SESSION['verification_page'])) {

echo '<div class="wrap_dossier">';

	echo '<h4>'. $_SESSION['nom_ecole_session'] .'</h4>';
	$class = $_SESSION['class'];
	$resultatClass = $connexion->query("SELECT class, nom_dossier FROM dossiers WHERE class = '$class' ");
	

	while ($rowClass = $resultatClass->fetch()) {
	?>

		<form method="POST" action="document.php">
			<input type="" name="nom_dossier" value="<?php echo $rowClass["nom_dossier"]; ?>" hidden="name">
			
			<input type="submit" value="<?php 
			if($rowClass["nom_dossier"] == "sujetevaluation")
			{
				echo "sujet d'évaluation";
			}elseif($rowClass["nom_dossier"] == "sujetexamen")
			{
				echo "sujet d'examen";
			}else
			{
				echo $rowClass["nom_dossier"];
			}
			 
			?>" class="dossier_button">
		</form>

	<?php
	}
echo '</div>';

	$resultatClass->closeCursor();

	 ?>
<?php 
}else{
	header('Location: ../index.php');
}

?>

</div>

</body>
</html>