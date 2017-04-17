<?php
ob_start();
session_start();
$pagename="membres_modifier";
include('header.php');
?><div class="col-lg-12 col-md-12 col-ls-12"><?php
if($_POST AND isset($_GET['id'])){
	$id=$_GET['id'];
	$msg='';
	if(empty($_POST['pseudo'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un pseudo !</div>';
	}
	if(empty($_POST['prenom'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un prenom !</div>';
	}
	if(empty($_POST['nom'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un nom !</div>';
	}
	if(empty($_POST['email'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un email !</div>';
	}

	if(isset($_POST['mdp_actuel'])){
		$mdp=$_POST['mdp_actuel'];
	}
	if(!empty($_POST['password'])){
		$mdp=sha1($_POST['password']);
	}

	$pseudo=$_POST['pseudo'];
	$prenom=$_POST['prenom'];
	$nom=$_POST['nom'];
	$email=$_POST['email'];
	$mdp=$mdp;
	$statut=$_POST['statut'];

	if(empty($msg)){
		$modif = $pdo->prepare("UPDATE membre SET pseudo='$pseudo', prenom='$prenom', nom='$nom', email='$email', mdp='$mdp', statut='$statut' WHERE id_membre='".$id."'");
		$modif->bindValue(':pseudo', $_POST['pseudo']);
		$modif->bindValue(':prenom', $_POST['prenom']);
		$modif->bindValue(':nom', $_POST['nom']);
		$modif->bindValue(':email', $_POST['email']);
		$modif->bindValue(':mdp', $mdp);
		$modif->bindValue(':statut', $_POST['statut']);
		$modif->execute();
		header('Location: '.$racinea.'membres/');
	}
	echo $msg;
}else{
	header('Location: '.$racinea.'membres/');
}

?>
<style type="text/css">
	label{color: white};
</style>
<form method="POST" action="<?= $racinea ?>membres_modifier.php?id=<?= $_GET['id'] ?>" data-toggle="validator" novalidate="true">
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group has-feedback">
			<label>Nom d'utilisateur</label>
			<input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" id="pseudo" value="<?= $_POST['pseudo'] ?>" required data-error="Vous devez choisir un pseudo">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group has-feedback">
			<label>Prénom</label>
			<input type="text" class="form-control" value="<?= $_POST['prenom'] ?>" placeholder="Prénom" id="prenom" name="prenom" required data-error="Vous devez écrire un Prénom">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group has-feedback">
			<label>Nom</label>
			<input type="text" class="form-control" value="<?= $_POST['nom'] ?>" placeholder="Nom" id="nom" name="nom" required data-error="Vous devez écrire un Nom">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group has-feedback">
			<label>Email</label>
			<input type="email" class="form-control" value="<?= $_POST['email'] ?>" id="email" placeholder="Email" name="email"  required data-error="Vous avez oublié d'indiquer votre mail">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group">
			<label>Nouveau mot de passe <span class="small">(6 caract min.)</span></label>
			<input type="hidden" name="mdp_actuel" value="<?= $_POST['mdp_actuel'] ?>">
			<input type="password" class="form-control" id="password" value="" placeholder="Mot de passe" name="password">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-ls-6">
		<div class="form-group">
			<label for="civilite">Sexe</label>
			<select name="civilite" id="civilite" class="form-control">
				<option <?php if($_POST['civilite']=='h'){echo "selected";} ?> value="h">Homme</option>
				<option <?php if($_POST['civilite']=='f'){echo "selected";} ?> value="f">Femme</option>
				<option <?php if($_POST['civilite']=='a'){echo "selected";} ?> value="a">Autre</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label>Statut</label>
		<select name="statut" id="statut" class="form-control">
			<option <?php if($_POST['statut']==0){echo "selected";} ?> value="0">Utilisateur</option>
			<option <?php if($_POST['statut']==1){echo "selected";} ?> value="1">Admin</option>
			<option <?php if($_POST['statut']==2){echo "selected";} ?> value="2">Désactivé</option>
		</select>
	</div>
	<input type="submit" id="submitmembres" value="Je modifie le membre" class="btn btn-default">
</form>
</div>