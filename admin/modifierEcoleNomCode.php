<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

// je peut uniquement modifier le contenu des ecoles sans le supprimer
session_start();

// connexion a la base de donnee
require '../connection/dataConnexion.php'; //connexion a la base

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

 	<!-- si le code de l'ecode sera tapper et existe, on accede a ses donnees -->
 	<?php
if (isset($_SESSION['verification_page_admin_sous'])) {

 	if (isset($_POST['code_ecole']) AND !empty($_POST['code_ecole'])){

 		$req = $connexion->prepare("SELECT *FROM ecoles WHERE code_ecole = ?");
		$req->execute(array($_POST['code_ecole']));
		$result = $req->fetch();

		$_SESSION['id'] = $result['id'];  //on recupere le id de l'ecole

		// si le code existe, on recupere les anciennes donnees dans la base
		if (!empty($result)) {
		?>
			<form method="post" action="modifierEcolePage.php" enctype="multipart/form-data">

				<div >
					<label for="code_ecole">Code de l'ecole</label><br>
					<input type="text" name="code_ecole" id="code_ecole" value="<?php echo $result['code_ecole'] ; ?>"><br><br>
					<label for="nom_ecolee">Nom de l'ecole</label><br>
					<input type="text" name="nom_ecolee" id="nom_ecolee" value="<?php echo $result['nom_ecole'] ; ?>"><br><br>

					<input type="submit" value="Modifier">
				</div>
				
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
 	<form method="post" action="modifierEcoleNomCode.php">

 		<div class="form_modifEcolNomCode">
 			<label for="code_ecole">Entrer le code de l'école</label><br>
	 		<input type="text" name="code_ecole" autofocus required=""><br>

	 		<input type="submit" name="Entrer">
 		</div>

 	</form>

 <?php 
}else{
	header('Location: ../index.php');
}

 ?>
 
 </body>
 </html>

