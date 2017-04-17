<?php
ob_start();
session_start();
$pagename="salles_modifier";
include('header.php');

if($_POST AND isset($_GET['id'])){
	$id=$_GET['id'];
	$msg='';
	if(empty($_POST['titre'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un nom de salle !</div>';
	}
	if(empty($_POST['description'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une description.</div>';
	}

	if(empty($_POST['ville'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une ville.</div>';
	}

	if(empty($_POST['adresse'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une adresse.</div>';
	}

	if(empty($_POST['codepostal'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter un codepostal.</div>';
	}

	if(empty($_POST['capacite'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une capacite.</div>';
	}
	if (!is_numeric($_POST['capacite'])){  
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Chiffres seulement acceptés pour la Capacité.</div>';
	}

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

	if(empty($msg)){
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
	}
	echo $msg;
}else{
	header('Location: '.$racinea.'salles/');
}

?>
<style type="text/css">
	label{color: white};
</style>
<form method="POST" action="<?= $racinea ?>salles_modifier.php?id=<?= $_POST['id'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
	<div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
		<div class="form-group has-feedback">
			<label>Titre</label>
			<input type="text" class="form-control" name="titre" placeholder="Titre" id="titre" value="<?= $_POST['titre'] ?>" required data-error="Vous devez ajouter un titre">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
		<div class="form-group has-feedback">
			<label>Description</label>
			<textarea class="form-control" id="description" name="description" required data-error="Vous devez ajouter une description"><?= $_POST['description']; ?></textarea>
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<label>Ville</label>
		<select name="ville" id="ville" class="form-control" onchange="changeSelect(this);">
			<option <?php if($_POST['categorie']=='paris'){echo "selected";} ?> value="paris">Paris</option>
			<option <?php if($_POST['categorie']=='lyon'){echo "selected";} ?> value="lyon">Lyon</option>
			<option <?php if($_POST['categorie']=='marseille'){echo "selected";} ?> value="marseille">Marseille</option>
		</select>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<div class="form-group has-feedback">
			<label>Code postal</label>
			<input type="text" class="form-control" name="codepostal" placeholder="Code postal" id="codepostal" value="<?= $_POST['codepostal'] ?>" required data-error="Vous devez ajouter une Code postal">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<div class="form-group has-feedback">
			<label>Adresse</label>
			<input type="text" class="form-control" name="adresse" placeholder="Adresse" id="adresse" value="<?= $_POST['adresse'] ?>" required data-error="Vous devez ajouter une adresse">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<div class="form-group has-feedback">
			<label>Capacité</label>
			<input type="text" class="form-control" name="capacite" placeholder="Capacité" id="capacite" value="<?= $_POST['capacite'] ?>" required data-error="Vous devez ajouter une Capacité">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<label>Catégorie</label>
		<select name="categorie" id="categorie" class="form-control">
			<option <?php if($_POST['categorie']==1){echo "selected";} ?> value="1">Réunion</option>
			<option <?php if($_POST['categorie']==2){echo "selected";} ?> value="2">Bureau</option>
			<option <?php if($_POST['categorie']==3){echo "selected";} ?> value="3">Formation</option>
		</select>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
		<label>Votre photo <span></span></label>
		<div class="btn btn-success">
			<input type="hidden" name="photo_actuelle" value="<?= $_POST['photo'] ?>">
			<input name="photo" class="uploads" id="photo" type="file" id="photo" accept="image/*" class="uploads"/>
		</div>
	</div>
	<input type="submit" id="submitsalle" value="Je modifie la salle" class="btn btn-default">
</form>