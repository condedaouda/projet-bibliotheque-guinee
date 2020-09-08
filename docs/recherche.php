<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand"><?php echo $_SESSION['nom_ecole_session'] ?></a>
	<form method="post" action="rechercheFinale.php" class="form-inline">
		<input class="form-control mr-sm-2" type="search" name="recherche" placeholder="<?php echo 'chercher'. $val_doc_search; ?>" aria-label="Search" required>
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</nav>


</body>
</html>