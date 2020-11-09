<?php

try {

	$serveur = "localhost";
	$login = "root";
	$pass = "";

	$connexion = new PDO("mysql:host=$serveur;dbname=coursavaya", $login, $pass); 
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
	die('Erreur : ' .$e.getMessage());
}
 ?>