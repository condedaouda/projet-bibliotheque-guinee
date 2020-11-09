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
    if (isset($_POST['nom']) and isset($_POST['slogant'])) {
        require '../../../connection/dataConnexion.php'; //connexion a la

        $cheminLivre = "../../../photo/" .$_FILES['livre']['name'];
        $resultaLivre = move_uploaded_file($_FILES['livre']['tmp_name'], $cheminLivre);

        if ($resultaLivre) {
            $requete = $connexion->prepare(
            "INSERT INTO ecoles(code_ecole, nom_ecole, photo, slogant)
            VALUES(:code_ecole, :nom_ecole, :photo, :slogant)"
            );

            $requete->bindParam(':code_ecole', $_POST['code']);
            $requete->bindParam(':nom_ecole', $_POST['nom']);
            $requete->bindParam(':photo', $_FILES['livre']['name']);
            $requete->bindParam(':slogant', $_POST['slogant']);

            $requete->execute();
            echo '<div class="btn_apres_ajout">';
                echo '<h4>Ecole ajoutée</h4>';
                echo '<button type="button" class="btn btn-success"><a href="../ecole.php">Retour</a></button><br><br>';
            echo '</div>'; 
        
        }

        die();
    }

    ?>

<div class="form_ajout_livre">
    <form method="post" action="ajoutEcole.php" enctype="multipart/form-data" >

        <label for="nom">Nom de l'ecole</label><br>
        <input type="text" name="nom" required><br><br>

        <label for="code">Code de l'ecole</label><br>
        <input type="text" name="code" required><br><br>

        <label for="slogant">Slogant de l'ecole</label><br>
        <textarea name="slogant" rows="5" cols="40" ></textarea><br>

        <label for="livre">Photo de l'école</label><br>
        <input type="file" name="livre" id="livre" required><br><br>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>

</body>
</html>