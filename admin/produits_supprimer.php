<?php
ob_start();
session_start();
include('header.php');

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat=$pdo->prepare("SELECT * FROM produit WHERE id_produit=:id");
	$resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat->execute();
	if($resultat->rowCount() > 0){
		$produit=$resultat->fetch(PDO::FETCH_ASSOC);
		$resultat=$pdo->exec("DELETE FROM produit WHERE id_produit=$produit[id_produit]");
		if($resultat != FALSE){
			header('Location:'.$racinea.'produits/');
		}
	}else{
		header('Location:'.$racinea.'produits/');
	}
}else{
	header('Location:'.$racinea.'produits/');
}
?>