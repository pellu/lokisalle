<?php
ob_start();
session_start();
include('config.php');

$date_enregistrement = date("d-m-y");


$resultat = $pdo -> prepare("
INSERT INTO commande (id_produit, id_membre, date_enregistrement) 
VALUES (:id_produit, :id_membre, :date_enregistrement)");

$resultat -> bindValue(':id_produit', $_POST['id_produit'], PDO::PARAM_STR);
$resultat -> bindValue(':id_membre', $_SESSION['userid'], PDO::PARAM_INT);
$resultat -> bindValue(':date_enregistrement', $date_enregistrement, PDO::PARAM_INT);
$resultat -> execute();

$modif=$pdo->prepare("UPDATE produit SET etat='reserve' WHERE id_produit=:id_produit");
$modif -> bindValue(':id_produit', $_POST['id_produit'], PDO::PARAM_STR);
$modif -> execute();

//redirection index
header('Location:'.$racines.'');