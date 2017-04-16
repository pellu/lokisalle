<?php
ob_start();
session_start();
$pagename="salles_modifier";
include('header.php');

if($_POST AND isset($_GET['id'])){
	$id=$_GET['id'];


	$nom_photo='default.jpg';
	if(isset($_POST['photo_actuelle'])){
		$nom_photo=$_POST['photo_actuelle'];
	}

	if(!empty($_FILES['photo']['name'])){
		//Génération de l'url aléatoire pour l'image
		function random($str) {
			$string = "";
			$url = "abcdefghijklmnpqrstuvwxy0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			srand((double)microtime()*1000000);
			for($i=0; $i<$str; $i++) {
				$string .= $url[rand()%strlen($url)];
			}
			return $string;
		}
		$url = random(10);
		$element = pathinfo($_FILES['photo']['name']);
		$nom_photo=$url.'_'.$_SESSION['user'].'_'.time().'.'.$element['extension'];

		$chemin_photo= RACINE_SERVEUR.$racine.'images/'.$nom_photo;
		copy($_FILES['photo']['tmp_name'], $chemin_photo);
	}


	$titre=$_POST['titre'];
	$description=$_POST['description'];
	$adresse=$_POST['adresse'];
	$cp=$_POST['codepostal'];
	$ville=$_POST['ville'];
	$capacite=$_POST['capacite'];
	$categorie=$_POST['categorie'];

	$modif = $pdo->prepare("UPDATE salle SET titre='$titre', description='$description', photo='$nom_photo', ville='$ville', adresse='$adresse', cp='$cp', capacite='$capacite', categorie='$categorie' WHERE id_salle='".$id."'");
	$modif->bindParam(':titre', $_POST['titre']);
	$modif->bindParam(':description', $_POST['description']);
	$modif->bindParam(':photo', $nom_photo);
	$modif->bindParam(':ville', $_POST['ville']);
	$modif->bindParam(':adresse', $_POST['adresse']);
	$modif->bindParam(':cp', $_POST['codepostal']);
	$modif->bindParam(':capacite', $_POST['capacite']);
	$modif->bindParam(':categorie', $_POST['categorie']);
	$modif->execute();
	header('Location: '.$racinea.'salles/');
}else{
 // 	header('Location: '.$racinea.'salles/');
}