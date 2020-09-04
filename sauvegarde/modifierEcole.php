<?php 
// je peut uniquement modifier le contenu des ecoles sans le supprimer
session_start();

// connexion a la base de donnee
require '../dataConnexion.php'; //connexion a la base

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>

 	<!-- si le code de l'ecode sera tapper et existe, on accede a ses donnees -->
 	<?php 
 	if (isset($_POST['code_ecole']) AND !empty($_POST['code_ecole'])){

 		$req = $connexion->prepare("SELECT *FROM ecoles WHERE code_ecole = ?");
		$req->execute(array($_POST['code_ecole']));
		$result = $req->fetch();

		$_SESSION['id'] = $result['id'];  //on recupere le id de l'ecole

		// si le code existe, on recupere les anciennes donnees dans la base
		if (!empty($result)) {
		?>
			<form method="post" action="modifierEcolePage.php" enctype="multipart/form-data">
				<label for="code_ecole">Code de l'ecole</label><br>
				<input type="text" name="code_ecole" id="code_ecole" value="<?php echo $result['code_ecole'] ; ?>"><br><br>

				<label for="nom_ecole">Nom de l'ecole</label><br>
				<input type="text" name="nom_ecole" id="nom_ecole" value="<?php echo $result['nom_ecole'] ; ?>"><br><br>

				<input type="submit" value="Modifier">
			</form>
		<?php 

		die();

		}else
		{
			echo "Ce code n'existe pas dans la base";
		}
	}

 	 ?>
 	


<!-- on entre le code de l'ecole -->
 	<form method="post" action="modifierEcole.php">
 		<label for="code_ecole">Entrer le code de l'école</label><br>
 		<input type="text" name="code_ecole"><br>

 		<input type="submit" name="Entrer">
 	</form>
 
 </body>
 </html>

