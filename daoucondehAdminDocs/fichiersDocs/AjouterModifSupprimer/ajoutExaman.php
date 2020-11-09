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
    if (isset($_POST['annee']) and !empty($_FILES['livre']['name'])) {
       
        $class = $_SESSION['classe_examen'] ;
        $matiere = $_SESSION['matiere_examen'];

        $cheminLivre = "../../../sujetExamen/$class/$matiere/" .$_FILES['livre']['name'];
        $resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

        if ($resultaLivre) {
            $requete = $connexion->prepare(
            "INSERT INTO sujetExamen(image, class, matiere, annee)
            VALUES(:image, :class, :matiere, :annee)"
            );

            $requete->bindParam(':image', $_FILES['livre']['name']);
            $requete->bindParam(':class', $class);
            $requete->bindParam(':matiere', $matiere);
            $requete->bindParam(':annee', $_POST['annee']);

            $requete->execute();
            echo '<div class="btn_apres_ajout">';
                echo '<h4>Examen ajouté</h4>';
                echo '<button type="button" class="btn btn-success"><a href="../examen.php">Retour</a></button><br><br>';
            echo '</div>';       
        }

        die();
    }

    ?>


    <div class="form_ajout_livre">
        <form method="post" action="ajoutExaman.php" enctype="multipart/form-data" >
            <label for="annee">Annee</label><br>
            <input type="text" name="annee" id="annee" required><br><br>

            <label for="livre">sujet(fichier en pdf)</label><br>
            <input type="file" name="livre" id="livre" required><br><br>

            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</body>
</html>