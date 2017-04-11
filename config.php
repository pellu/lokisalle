<?php
$pdo = new PDO('mysql:dbname=lokisalle;host=localhost','root','');

$racine='/lokisalle/'; //Dev /lokisalle/ - Prod /
$racines='http://'.$_SERVER["HTTP_HOST"].$racine.'';
$racinea='http://'.$_SERVER["HTTP_HOST"].$racine.'admin/';

//Verif user existe
if(isset($_SESSION['membre'])){
	$pseudo=$_SESSION['membre'];
	$req = $pdo->query('SELECT * FROM users WHERE pseudo="'.$pseudo.'"');
	$resultsql = $req->fetch();
	$levelstatut=$resultsql['statut'];
	//statut 0 = user normal
	//statut 1 = admin
}else{
	$levelstatut=0;
}
?>