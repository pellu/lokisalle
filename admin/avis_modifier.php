<?php
ob_start();
session_start();
$pagename="salles_modifier";
include('header.php');

if($_POST AND isset($_GET['id'])){
	$id=$_GET['id'];
	$msg='';
	if(empty($_POST['commentaire'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un commentaire !</div>';
	}

	$commentaire=$_POST['commentaire'];

	if(empty($msg)){
		$modif = $pdo->prepare("UPDATE avis SET commentaire='$commentaire' WHERE id_avis='".$id."'");
		$modif->bindParam(':commentaire', $_POST['commentaire']);
		$modif->execute();
		header('Location: '.$racinea.'avis/');
	}
	echo $msg;
}else{
	header('Location: '.$racinea.'avis/');
}

?>
<style type="text/css">
	label{color: white};
</style>
<form method="POST" action="<?= $racinea ?>avis_modifier.php?id=<?= $_GET['id'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
	<div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
		<div class="form-group has-feedback">
			<label>commentaire</label>
			<input type="text" class="form-control" name="commentaire" placeholder="Commentaire" id="commentaire" value="<?= $_POST['commentaire'] ?>" required data-error="Vous devez ajouter un commentaire">
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
	</div>
	<input type="submit" id="submitsalle" value="Je modifie l'avis" class="btn btn-default">
</form>