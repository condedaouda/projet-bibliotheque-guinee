<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	//verification de la taille du mot de passe
	$numero = $_POST['numero'];
	$tail_numero = strlen("$numero") ;

	// la requete pour verifier si le numero existe deja dans la tabe
	$numberVerification = $connexion->query("SELECT numero_phone FROM donnee_eleves WHERE numero_phone = '$numero' ");
	$numberdonnees = $numberVerification->fetch();

	// pour verifier si la taille est correct et si le numero commence par 6
	if ($tail_numero < 9 OR !preg_match("#^6#", "$numero") OR $tail_numero > 13) {
		echo "<mark>le format du numéro de téléphone était incorrect</mark>";
	}elseif (!empty($numberdonnees)) {
		echo "<mark>ce numéro de téléphone est déja utilisé</mark>";
	}else
	{
		$codeVerification = $_POST['code'];
		// on verifit si le code de lecole existe dans la base, si ça existe on recupere le nom de lecole et on enregistre les donnees
		$resultatVerification = $connexion->query("SELECT code_ecole, nom_ecole FROM ecoles WHERE code_ecole = '$codeVerification' ");
		$row = $resultatVerification->fetch();


		if (!empty($row)) {

			// on recupere le nom de l'ecole
			$nom_ecole = $row['nom_ecole'];

			$requete = $connexion->prepare(
			"INSERT INTO donnee_eleves(nom, prenom, numero_phone, code_ecole, nom_ecole, class)
			VALUES(:nom, :prenom, :numero_phone, :code_ecole, :nom_ecole, :class)"
			);

			$requete->bindParam(':nom', $_POST['nom']);
			$requete->bindParam(':prenom', $_POST['prenom']);
			$requete->bindParam(':numero_phone', $_POST['numero']);
			$requete->bindParam(':code_ecole', $_POST['code']);
			$requete->bindParam(':nom_ecole', $nom_ecole);
			$requete->bindParam(':class', $_POST['classe']);

			$requete->execute();

			// la recuperation de la class
			$class = $_POST['classe'];

			$_SESSION['class'] = $_POST['classe'];

			$resultatClass = $connexion->query("SELECT class, nom_matiere FROM matieres WHERE class = '$class' ");
			echo 'Bienvenue dans la bibliothèque numérique de <mark>'. $nom_ecole .'</mark>';
			echo '<br>classe : '. $class;

			while ($rowClass = $resultatClass->fetch()) {
			?>

				<!-- l'affichage des matieres -->
				<form method="POST" action="dossiers.php">
					<!-- on prend le nom de la classe comme reference -->
					<input type="" name="nom_matiere" id="nom_matiere" value="<?php echo $rowClass["nom_matiere"]; ?>" hidden="name">
					<input type="submit" value="<?php echo $rowClass["nom_matiere"]; ?>">
				</form>

			<?php
			}

			$resultatClass->closeCursor();
			die();
		}else{
			echo "code de l'ecole incorrecte";
		}

		die();
	}

	 ?>

</body>
</html>