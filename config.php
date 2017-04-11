<?php
$pdo = new PDO('mysql:dbname=lokisalle;host=localhost','root','');
//$pdo = new PDO('mysql:dbname=lokisalle;host=localhost','root','root');

$racine='/lokisalle/';
//$racine='/';
$racines='http://'.$_SERVER["HTTP_HOST"].$racine.'';
$racinea='http://'.$_SERVER["HTTP_HOST"].$racine.'admin/';
$actuel = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

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
?>