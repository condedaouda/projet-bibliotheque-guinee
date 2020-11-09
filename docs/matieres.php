<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../connection/dataConnexion.php'; //connexion a la base

// pour recuperer le nom de lecole
$nom_ecole = $_SESSION['nom_ecole_session'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>
<body>
    <style>
		div#content_body {
			position: absolute;
			width : 100%;
			height: auto;
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

$terminaleM = array ('biologie', 'chimie', 'français', 'geographie', 'geologie', 'histoire', 'maths', 'physique');
$terminaleE = array ('biologie', 'chimie', 'français', 'geographie', 'geologie', 'histoire', 'maths', 'physique');
$terminaleS = array ('biologie', 'chimie', 'français', 'geographie', 'geologie', 'histoire', 'maths', 'physique');

    // on garde la valeur de la class dans une variable globale
	if (isset($_POST['classe'])) {
		$_SESSION['classe_valeur'] = $_POST['classe'];
	}

	// pour garder la valeur de classe quand on se retourne sur la page
	if (isset($_SESSION['classe_valeur']) AND $_SESSION['classe_valeur'] != '' AND !isset($_POST['valeur_retour'])) {
		// on change la classe de l'eleve s'il fait des modifications
		$class = $_SESSION['class'] = $_SESSION['classe_valeur'];
		//$resultatClass = $connexion->query("SELECT nom_matiere FROM matieres WHERE class = '$class' ");

echo '<div class="wrap_matieres">';       
        
        echo '<h5>'. $nom_ecole .'</h5>';

        // s'il ya le slogant, on l'affiche au cas contraire on laisse
        
		if (!empty($_SESSION['slogant_ecole'])) {
			// le slogant de l'ecole
	 		echo '<div class="slogant_matieres">'. $_SESSION['slogant_ecole']. '</div>';
		}

		echo '<p class=valeur_class>'. $class .'</p>';
        ?>
		
		<?php 


		if($_SESSION['classe_valeur'] === 'Terminale SM')
			{
				foreach($terminaleM as $element) {
				?>

				
					<form method="POST" action="dossiers.php">
						<input type="" name="nom_matiere" value="<?php echo $element; ?>" hidden="name">
						<input type="submit" value="<?php echo $element; ?>" class="nom_matiere">
					</form>
				

				<?php
				}
			}elseif($_SESSION['classe_valeur'] === 'Terminale SE'){
				foreach($terminaleE as $element) {
					?>
						<form method="POST" action="dossiers.php">
							<input type="" name="nom_matiere" value="<?php echo $element; ?>" hidden="name">
							<input type="submit" value="<?php echo $element; ?>" class="nom_matiere">
						</form>
					
	
					<?php
					}
			}else{
				foreach($terminaleS as $element) {
					?>
	
					
						<form method="POST" action="dossiers.php">
							<input type="" name="nom_matiere" value="<?php echo $element; ?>" hidden="name">
							<input type="submit" value="<?php echo $element; ?>" class="nom_matiere">
						</form>
					
	
					<?php
					}
			}
echo '</div>';
		die();
	}

?>

</div>
    
</body>
</html>