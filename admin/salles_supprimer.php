<?php
ob_start();
session_start();
include('header.php');

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat=$pdo->prepare("SELECT * FROM salle WHERE id_salle=:id");
	$resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat->execute();
	if($resultat->rowCount() > 0){
		$salle=$resultat->fetch(PDO::FETCH_ASSOC);
		$chemin_photo_a_supprimer=RACINE_SERVEUR.$racine.'images/'.$salle['photo'];
		if($salle['photo'] != 'default.jpg' && file_exists($chemin_photo_a_supprimer)){
			unlink($chemin_photo_a_supprimer);
		}
		$resultat=$pdo->exec("DELETE FROM salle WHERE id_salle=$salle[id_salle]");
		if($resultat != FALSE){
			header('location:'.$racinea.'salles/');
		}
	}else{
		header('location:'.$racinea.'salles/');
	}
}else{
	header('location:'.$racinea.'salles/');
}
?>