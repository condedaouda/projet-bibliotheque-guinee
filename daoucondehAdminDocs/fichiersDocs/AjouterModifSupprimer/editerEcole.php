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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../../../css/secondeAdmin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php

    if (isset($_POST['editer'])) {
        $_SESSION['ecole_edit_id'] = $_POST['editer'];
    }
    $id =  $_SESSION['ecole_edit_id'];

    $resultat = $connexion->query("SELECT * FROM ecoles WHERE id = '$id'");
    $donnees = $resultat->fetch();


    if (isset($_POST['nom']) and isset($_POST['code'])) {
        
        $cheminLivre = "../../../photo/" .$_FILES['livre']['name'];
        $resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

        if ($resultaLivre) {
            $modification = $connexion->prepare("UPDATE ecoles 
            SET code_ecole = :code_ecole,
                nom_ecole = :nom_ecole,
                photo = :photo,
                slogant = :slogant
                
            WHERE id = :id");

                $modification->execute(array(
                    'code_ecole' => $_POST['code'],
                    'nom_ecole' => $_POST['nom'],
                    'photo' => $_FILES['livre']['name'],
                    'slogant' => $_POST['slogant'],

                    'id' => $id
                ));
        }

        echo '<div class="after_edit_doc">';
            echo '<h4>Modification éffectuée</h4>';
            echo '<button type="button" class="btn btn-success"><a href="../ecole.php">Retour</a></button><br><br>';
        echo '</div>';

            die();
    }
    
    ?>


<div class="form_ajout_livre">
    <form method="post" action="editerEcole.php" enctype="multipart/form-data" >

        <label for="nom">Nom de l'ecole</label><br>
        <input type="text" name="nom" value='<?php echo $donnees['nom_ecole'] ?>' required><br><br>

        <label for="code">Code de l'ecole</label><br>
        <input type="text" name="code" value='<?php echo $donnees['code_ecole'] ?>' required><br><br>

        <label for="slogant">Slogant de l'ecole</label><br>
        <textarea name="slogant" rows="3" cols="35" ><?php echo $donnees['nom_ecole'] ?></textarea><br>

        <p>la nouvelle photo doit etre la meme que celle de l'ancienne ou vous supprimer commplement l'école et l'ajouter à nouveau.</p>
        <label for="livre">Photo de l'école</label><br>
        <img src="../../../photo/<?php echo $donnees['photo']; ?>" class='img-thumbnail photo_livre' style="width:200px"><br><br>
        <input type="file" name="livre" id="livre"  required><br><br>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>

</body>
</html>