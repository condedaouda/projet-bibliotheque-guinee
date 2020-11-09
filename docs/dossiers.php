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
$dossier = array ('livres', 'brochures', 'sujetexamen');
if (isset($_SESSION['verification_page'])) {

echo '<div class="wrap_dossier">';

	echo '<h5>'. $_SESSION['nom_ecole_session'] .'</h5>';	

	foreach($dossier as $element) {
	?>

		<form method="POST" action="document.php">
			<input type="" name="nom_dossier" value="<?php echo $element; ?>" hidden="name">
			
			<input type="submit" value="<?php 
			if($element == "sujetevaluation")
			{
				echo "sujet d'évaluation";
			}elseif($element == "sujetexamen")
			{
				echo "sujet d'examen";
			}else
			{
				echo $element;
			}
			 
			?>" class="dossier_button">
		</form>

	<?php
	}
echo '</div>';

	 ?>
<?php 
}else{
	header('Location: ../index.php');
}

?>

</div>

</body>
</html>