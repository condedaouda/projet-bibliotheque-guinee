<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
require '../../../connection/dataConnexion.php'; //connexion a la 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../css/secondeAdmin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <?php

    $id =  $_POST['supprimer'];
    $resultat = $connexion->query("SELECT * FROM sujetExamen WHERE id = '$id'");
    $donnees = $resultat->fetch();

    $image_fichier_supp =  $donnees['image'];
    $nom_class_supp = $donnees['class'];
    $nom_matiere_supp =  $donnees['matiere'];

    // la suppression dans le fichier du serveur
    unlink ("../../../sujetExamen/$nom_class_supp/$nom_matiere_supp/$image_fichier_supp");

    // la suppression dans la base de donne
    $req = $connexion->prepare("DELETE FROM sujetExamen WHERE id = ?");
    $req->execute(array($id));
    ?>

    <div class="btn_suppression">
        <h4>Supprission effectuée</h4>
    <button type="button" class="btn btn-success"><a href="../examen.php">Retour</a></button>
</div>
</body>
</html>