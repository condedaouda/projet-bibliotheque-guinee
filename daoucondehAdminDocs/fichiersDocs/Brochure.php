<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);


session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../../css/secondeAdmin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <?php
require '../../connection/dataConnexion.php'; //connexion a la 


if (isset($_POST['classe']) and isset($_POST['matiere'])) {

    $classe = $_POST['classe'];
    $matiere = $_POST['matiere'];
    $_SESSION['classe_brochure'] = $_POST['classe'];
    $_SESSION['matiere_brochure'] = $_POST['matiere'];
    
    
// echo '<button type="button" class="btn btn-success btn_ecole_ajout"><a href="./AjouterModifSupprimer/ajoutBrochure.php">Ajouter</a></button><br><br>';
// recuperation des donnees
?>

<div class="a_btn_ajout">
    <a href="./AjouterModifSupprimer/ajoutBrochure.php">Ajouter</a></button>
</div>
<table class="table">

<?php
$resultat = $connexion->query("SELECT * FROM brochures WHERE class = '$classe' AND matiere = '$matiere'");
while ($donnees = $resultat->fetch()) {
?>

    <tbody>
        <tr>
            <td>
                <?php echo $donnees['commentaire']; ?>
            </td>

            <td>
                <form method="POST" action="./AjouterModifSupprimer/editerBrochure.php">
                    <input type="" name="editer" value="<?php echo $donnees["id"]; ?>" hidden="name">
                    <button type="submit" class="btn btn-success supprimer">Editer</button>
                </form>
            </td>

            <td>
                <form method="POST" action="./AjouterModifSupprimer/supprimerBrochure.php">
                    <input type="" name="supprimer" value="<?php echo $donnees["id"]; ?>" hidden="name">
                    <button type="submit" class="btn btn-success">Supprimer</button>
                </form>
            </td>

            <td>
            <img src="../../brochures/<?php echo $classe; ?>/<?php echo $matiere; ?>/<?php echo $donnees['image']; ?>" class='img-thumbnail photo_livre'>
            </td>

        </tr>
    </tbody>


    <?php
    }
    ?>
    </table>

    <?php
    die();
}
    ?>



    <div class="form_livre">
    <form method="post" action="Brochure.php">
        <label for="classe">Classe</label><br>
        <select name="classe" id="classe">
            <option value="Terminale SM">Terminale SM</option>
            <option value="Terminale SS">Terminale SS</option>
            <option value="Terminale SE">Terminale SE</option>
        </select><br><br>

        <label for="matiere">Matiere</label><br>
        <select name="matiere" id="matiere">
            <option value="histoire">Histoire</option>
            <option value="geographie">Geographie</option>
            <option value="physique">Physique</option>
            <option value="biologie">Biologie</option>
            <option value="chimie">Chimie</option>
            <option value="fransais">Fransais</option>
        </select><br><br>

        <input type="submit" value="Envoyer">
    </form>
</div>
</body>
</html>