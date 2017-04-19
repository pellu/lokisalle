<?php
$pdo = new PDO('mysql:dbname=lokisalle;host=localhost','root','root');
//MAC rajouter root

$racine='/lokisalle/'; // Prod / - pas prod /lokisalle/
$racinea='http://'.$_SERVER["HTTP_HOST"].'';
$racines='http://'.$_SERVER["HTTP_HOST"].$racine.'';
$racinea='http://'.$_SERVER["HTTP_HOST"].$racine.'admin/';
$racinep='http://'.$_SERVER["HTTP_HOST"].$racine.'admin/';
$actuel= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
define('RACINE_SERVEUR', $_SERVER["DOCUMENT_ROOT"]);

//Verif user existe
if(isset($_SESSION['user'])){
	$pseudo=$_SESSION['user'];
	$req = $pdo->query('SELECT * FROM membre WHERE pseudo="'.$pseudo.'"');
	$resultsql = $req->fetch();
	$levelstatut=$resultsql['statut'];
	//statut 0 = user normal
	//statut 1 = admin
}else{
	$levelstatut=0;
}

$url = $_SERVER['REQUEST_URI'];
$part = explode ("/", $url);
if(!empty($part[3])){
  $idproduit = $part[3]; //3 in local / 2 in prod  
}