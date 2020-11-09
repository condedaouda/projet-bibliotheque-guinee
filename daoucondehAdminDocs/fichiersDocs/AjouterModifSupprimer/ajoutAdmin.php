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

    if (isset($_POST['login']) and isset($_POST['pass'])) {
        require '../../../connection/dataConnexion.php'; //connexion a la 
        

        // Hachage du mot de passe
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        
        $requete = $connexion->prepare(
            "INSERT INTO admin(login, pass)
                VALUES(:login, :pass)"
            );
    
            $requete->bindParam(':login', $_POST['login']);
            $requete->bindParam(':pass', $pass_hache);
            $requete->execute();

            echo '<div class="btn_apres_ajout">';
            echo '<h4>Element ajouté</h4>';
               echo '<button type="button" class="btn btn-success"><a href="../admin.php">Retour</a></button>';
           echo '</div>';

        die();
    }
    
    
    ?>

    <div class="form_ajout_livre">
        <form method="POST" action="ajoutAdmin.php">

            <label for="login">Login</label><br>
            <input type="" name="login" required><br><br>

            <label for="pass">Password</label><br>
            <input type="" name="pass" required><br><br>

            <button type="submit" class="btn btn-success ">Ajouter</button>
        </form>
    </div>

</body>
</html>