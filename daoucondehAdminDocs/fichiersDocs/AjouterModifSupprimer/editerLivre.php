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

    $classee = $_SESSION['classe_livre'];
    $matieree = $_SESSION['matiere_livre'];

    if (isset($_POST['editer'])) {
        $_SESSION['livre_edit_id'] = $_POST['editer'];
    }
    $id =  $_SESSION['livre_edit_id'];

    $resultat = $connexion->query("SELECT * FROM livres WHERE id = '$id'");
    $donnees = $resultat->fetch();

    $class = $donnees['class'];
    $matiere =  $donnees['matiere'];

    if (isset($_POST['commentaire']) and !empty($_FILES['image']['name'])) {
        
        $cheminImage = "../../../livres/$class/$matiere/" .$_FILES['image']['name'];
        $cheminLivre = "../../../livres/$class/$matiere/" .$_FILES['livre']['name'];

        $resultaImage = move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);
        $resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

        $modification = $connexion->prepare("UPDATE livres 
		SET nom = :nom,
			image = :image,
            commentaire = :commentaire
			
		WHERE id = :id");

			$modification->execute(array(
				'nom' => $_FILES['livre']['name'],
                'image' => $_FILES['image']['name'],
                'commentaire' => $_POST['commentaire'],

				'id' => $id
            ));
            echo '<div class="after_edit_doc">';
                echo '<h4>Modification effectuee</h4>';
                echo '<button type="button" class="btn btn-success"><a href="../livre.php">Retour</a></button><br><br>';
            echo '</div>';
            die();
    }
    
    ?>


<div class="before_edit_doc">
    <form method="post" action="editerLivre.php" enctype="multipart/form-data" >
        <label for="commentaire">Commentaire</label><br>
        <textarea name="commentaire" rows="5" cols="40" required><?php echo  $donnees['commentaire']?></textarea><br>

        <p>les nouveaux image et document doivent avoir les memes noms que ceux des anciens ou vous supprimer commplement le livre et l'ajouter à nouveau.</p>

        <img src="../../../livres/<?php echo $classee; ?>/<?php echo $matieree; ?>/<?php echo $donnees['image']; ?>" class='img-thumbnail photo_livre' style="width:200px"><br>
        
        <label for="image">Image du livre(image de couverture)</label><br>
        <input type="file" name="image" id="image" required ><br><br>

        <label for="livre">Livre(fichier en pdf)</label><br>
        <input type="file" name="livre" id="livre" required><br><br>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>

</body>
</html>