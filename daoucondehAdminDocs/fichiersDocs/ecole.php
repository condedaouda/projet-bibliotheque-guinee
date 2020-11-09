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
    <div class="a_btn_ajout">
        <a href="./AjouterModifSupprimer/ajoutEcole.php">Ajouter</a></button>
    </div>
<div >
<table class="table">

<?php
require '../../connection/dataConnexion.php'; //connexion a la 
  
// echo '<button type="button" class="btn btn-success btn_ecole_ajout" ><a href="./AjouterModifSupprimer/ajoutEcole.php">Ajouter</a></button><br><br>';
// recuperation des donnees
$resultat = $connexion->query("SELECT * FROM ecoles where nom_ecole != 'admin'");
while ($donnees = $resultat->fetch()) {
?>

    <tbody>

        <tr>
            <td>
                    <?php echo $donnees['nom_ecole']; ?>
            </td>

            <td>
                    <?php echo $donnees['slogant']; ?>
            </td>

            <td>
                    <form method="POST" action="./AjouterModifSupprimer/editerEcole.php">
                        <input type="" name="editer" value="<?php echo $donnees["id"]; ?>" hidden="name">
                        <button type="submit" class="btn btn-success supprimer">Editer</button>
                    </form>
            </td>

            <td>
                    <form method="POST" action="./AjouterModifSupprimer/supprimerEcole.php">
                        <input type="" name="supprimer" value="<?php echo $donnees["id"]; ?>" hidden="name">
                        <button type="submit" class="btn btn-success">Supprimer</button>
                    </form>
            </td>

            <td>
                    <img src="../../photo/<?php echo $donnees['photo']; ?>" class='img-thumbnail photo_livre'>
            </td>
        
        </tr>
    </tbody>

    <?php
    }
    die();
    ?>

</table>
</div>
</body>
</html>