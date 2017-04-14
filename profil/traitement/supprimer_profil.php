<?php
session_start();
include('../../config.php');

$id=$_SESSION['userid'];

$modif = $pdo->prepare("UPDATE membre SET statut=:statut WHERE id_membre='".$id."'");
$modif->bindValue(':statut', 2);
$modif->execute();

unset($_SESSION['user']);
unset($_SESSION['userid']);
header('Location:'.$racines.'');