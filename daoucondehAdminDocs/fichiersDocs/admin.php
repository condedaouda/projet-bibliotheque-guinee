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
        
	// echo '<button type="button" class="btn btn-success btn_ecole_ajout"><a href="./AjouterModifSupprimer/ajoutAdmin.php">Ajouter</a></button><br><br>';
    // recuperation des donnees
    ?>
    <div class="a_btn_ajout">
        <a href="./AjouterModifSupprimer/ajoutAdmin.php">Ajouter</a>
    </div>


    <table class="table">
    
    <?php
    $resultat = $connexion->query("SELECT * FROM admin where login != 'daou' ");
    while ($donnees = $resultat->fetch()) {
    ?>

    <tbody>
        <tr>
            <td>
                <?php echo $donnees["login"]?>
            </td>

            <td>
                <form method="POST" action="./AjouterModifSupprimer/supprimerAdmin.php">
                    <input type="" name="supprimer" value="<?php echo $donnees["id"]; ?>" hidden="name">
                    <button type="submit" class="btn btn-success">Supprimer</button>
                </form> 
            </td>

        </tr>
    </tbody>

        <?php
        }
        ?>
        </table>

        <?php
      
        ?>
</body>
</html>