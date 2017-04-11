<?php
$pdo = new PDO('mysql:dbname=lokisalle;host=localhost','root','root');

<<<<<<< HEAD
$racine='/lokisalle/'; //Dev /lokisalle/ - Prod /
=======

$racine='/master/lokisalle/'; //Dev /lokisalle/ - Prod /
>>>>>>> 44fe3836549bccdbfa6a087d3251580de04f6f53
$racines='http://'.$_SERVER["HTTP_HOST"].$racine.'';
$racinea='http://'.$_SERVER["HTTP_HOST"].$racine.'admin/';
//TEST
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