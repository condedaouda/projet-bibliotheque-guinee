<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<form method="post" action="rechercheFinale.php">
		<div class="recherche_document">
	 		<div class="zone_recherche">
	 			<input type="search" name="recherche" placeholder="<?php echo 'chercher'. $val_doc_search; ?>" required>
	 		</div>

	 		<div class="button_recherche">
	 			<input type="submit" value="rechercher">
	 		</div>
		</div>
	</form>

</body>
</html>