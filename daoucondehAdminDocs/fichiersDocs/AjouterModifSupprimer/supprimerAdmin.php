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

require '../../../connection/dataConnexion.php'; //connexion a la 

$id =  $_POST['supprimer'];

// la suppression dans la base de donne
$req = $connexion->prepare("DELETE FROM admin WHERE id = ?");
$req->execute(array($id));
?>

<div class="btn_suppression">
    <h4>Supprission effectuée</h4>
    <button type="button" class="btn btn-success"><a href="../admin.php">Retour</a></button>
</div>
</body>
</html>