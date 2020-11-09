<?php 
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../connection/dataConnexion.php'; //connexion a la base

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" type="text/css" href="../css/responsive.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="classe_doc_detaile">
    <?php 

    $data = $chemin =  $_SESSION['nom_dossier'];
    $classe = $_SESSION['class'];
    $matiere = $_SESSION['nom_matiere'];
    $valeur_id = $_POST['nom_detail'];

    // si le dossier nest pas sujetevaluation
    $resultat = $connexion->query("SELECT * FROM $data WHERE class = '$classe' AND matiere = '$matiere' AND id = '$valeur_id' ");
    $donnees = $resultat->fetch();

    // echo "". $_POST['nom_detail']. "<br>";
    echo "Nom: ". $donnees['nom']. "<br>" ;
    echo "Détail: ". $donnees['commentaire']. "<br>";
    echo "Niveau: ". $_SESSION['class']. "<br>";
    echo"Genre: ". $_SESSION['nom_matiere']. "<br>";
    ?>

        <div class="box">
            <div class="image_conteneur">

                <a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>">					
                    <img src="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>" class='img-thumbnail photo_liv_bro'>
                </a>
            </div>
            
            <div class="container_lecture_telechargement">
                <div class="div_lecture_telechargement">
                    <button class="btn btn-light lecture"><a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['nom']; ?>" >Ouvrir</a></button>
                </div>

                <div class="div_lecture_telechargement"> 
                    <button class="btn btn-light telechargement"><a href="../<?php echo $chemin; ?>/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['nom']; ?>" download>Télécharger</a></button>
                </div>
            </div>


        </div><br>				

    <?php
    $resultat->closeCursor();
    
    ?>
</div>
</body>
</html>