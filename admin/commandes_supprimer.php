<?php
include('header.php');

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat=$pdo->prepare("SELECT * FROM commande WHERE id_commande=:id");
	$resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat->execute();
	if($resultat->rowCount() > 0){
		$commande=$resultat->fetch(PDO::FETCH_ASSOC);
		
		$resultat=$pdo->exec("DELETE FROM commande WHERE id_commande=$commande[id_commande]");
		if($resultat != FALSE){
			header('location:'.$racinea.'commandes/');
		}
	}else{
		header('location:'.$racinea.'commandes/');
	}
}else{
	header('location:'.$racinea.'commandes/');
}
?>