<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../connection/dataConnexion.php'; //connexion a la base

// pour recuperer le nom de lecole
$nom_ecole = $_SESSION['nom_ecole_session'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="icon" type="image/png" href="../photo/icon.png"/>
</head>

<body class='bod_class'>

	<?php 

// la verifation de l'acces a la page
if (isset($_SESSION['verification_page'])) {

	// on garde la valeur de la class dans une variable globale
	if (isset($_POST['classe'])) {
		$_SESSION['classe_valeur'] = $_POST['classe'];
	}

	// pour garder la valeur de classe quand on se retourne sur la page
	if (isset($_SESSION['classe_valeur']) AND $_SESSION['classe_valeur'] != '' AND !isset($_POST['valeur_retour'])) {
		// on change la classe de l'eleve s'il fait des modifications
		$class = $_SESSION['class'] = $_SESSION['classe_valeur'];
		$resultatClass = $connexion->query("SELECT nom_matiere FROM matieres WHERE class = '$class' ");

		echo '<p class="class_nom_ecole">'. $nom_ecole .'</p>';

		// s'il ya le slogant, on l'affiche au cas contraire on laisse
		if (!empty($_SESSION['slogant_ecole'])) {
			// le slogant de l'ecole
	 		echo '<div class="slogant_class">'. $_SESSION['slogant_ecole']. '</div>';
		}

		echo '<p class=valeur_class>Classe : '. $class .'</p>';
		?>
		
		<?php 

		while ($rowClass = $resultatClass->fetch()) {
		?>

		<form method="POST" action="dossiers.php">
			<input type="" name="nom_matiere" value="<?php echo $rowClass["nom_matiere"]; ?>" hidden="name">
			<input type="submit" value="<?php echo $rowClass["nom_matiere"]; ?>" class="nom_matiere">
		</form>

	<?php
		}

		$resultatClass->closeCursor();
		die();
	}
	
	 ?>

	 <?php echo '<p class="bienvenue">Bienvenue à la bibliothèque numérique de</p> <div id="nom_ecole">'. $nom_ecole .'</div>'; ?>

	 <a href="../photo/<?php echo $_SESSION['nom_photo_ecole'] ?>"><img src="../photo/<?php echo $_SESSION['nom_photo_ecole'] ?> " class="zoom_photo_ecole"></a>

	 <form method="post" action="classe.php">
	 	<label for="classe" class="class_label">Veuillez choisir votre classe</label><br>
		<select name="classe" id="classe">
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
       </select><br>

       <input type="submit" value="valider" class="class_button">	 	
	 </form>
<?php 
}else{
	header('Location: ../index.php');
}

?>

</body>
</html>