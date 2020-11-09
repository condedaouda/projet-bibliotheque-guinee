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
if (isset($_POST['commentaire']) and !empty($_FILES['image']['name'])) {
    
    $class = $_SESSION['classe_brochure'];
    $matiere = $_SESSION['matiere_brochure'];

    $cheminImage = "../../../brochures/$class/$matiere/" .$_FILES['image']['name'];
    $cheminLivre = "../../../brochures/$class/$matiere/" .$_FILES['livre']['name'];

    $resultaImage = move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);
    $resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

    if ($resultaImage AND $resultaLivre) {
        $requete = $connexion->prepare(
        "INSERT INTO brochures(nom, class, matiere, image, commentaire)
        VALUES(:nom, :class, :matiere, :image, :commentaire)"
        );

        $requete->bindParam(':nom', $_FILES['livre']['name']);
        $requete->bindParam(':class', $class);
        $requete->bindParam(':matiere', $matiere);
        $requete->bindParam(':image', $_FILES['image']['name']);
        $requete->bindParam(':commentaire', $_POST['commentaire']);

        $requete->execute();

        echo '<div class="btn_apres_ajout">';
            echo '<h4>Brochure ajoutée</h4>';
            echo '<button type="button" class="btn btn-success"><a href="../Brochure.php">Retour</a></button>';
        echo '</div>';
    
    }

    die();
}

?>
    


<div class="form_ajout_livre">
    <form method="post" action="ajoutBrochure.php" enctype="multipart/form-data" >
        <label for="commentaire">Commentaire</label><br>
        <textarea name="commentaire" rows="5" cols="40" required></textarea><br>

        <label for="image">Image du livre(image de couverture)</label><br>
        <input type="file" name="image" id="image" required ><br><br>

        <label for="livre">Livre(fichier en pdf)</label><br>
        <input type="file" name="livre" id="livre" required><br><br>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>

</body>
</html>