<?php
ob_start();
session_start();
$pagename="salles_modifier";
include('header.php');

if($_POST AND isset($_GET['id'])){
	$id=$_GET['id'];
	$msg='';
	if(empty($_POST['id_salle'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez choisir une salle !</div>';
	}
	if(empty($_POST['date_arrivee'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez une date d\'arrivée.</div>';
	}

	if(empty($_POST['date_depart'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez une date de départ.</div>';
	}

	if(empty($_POST['prix'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter un prix.</div>';
	}

	if(empty($_POST['etat'])){
		$msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter un état.</div>';
	}

	$id_salle=$_POST['id_salle'];
	$date_arrivee=$_POST['date_arrivee'];
	$date_depart=$_POST['date_depart'];
	$prix=$_POST['prix'];
	$etat=$_POST['etat'];

	if(empty($msg)){
		$modif = $pdo->prepare("UPDATE produit SET id_salle='$id_salle', date_arrivee='$date_arrivee', date_depart='$date_depart', prix='$prix', etat='$etat' WHERE id_produit='".$id."'");
		$modif->bindParam(':id_salle', $_POST['id_salle']);
		$modif->bindParam(':date_arrivee', $_POST['date_arrivee']);
		$modif->bindParam(':date_depart', $_POST['date_depart']);
		$modif->bindParam(':prix', $_POST['prix']);
		$modif->bindParam(':etat', $_POST['etat']);
		$modif->execute();
		header('Location: '.$racinea.'produits/');
	}
	echo $msg;
}else{
	header('Location: '.$racinea.'produits/');
}

?>
<style type="text/css">
	label{color: white};
</style>
<form method="POST" action="<?= $racinea ?>produits_modifier.php?id=<?= $_GET['id'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
	<div class="col-lg-12 col-md-12 col-ls-12">
		<div class="form-group">
			<label>Choix de la salle</label>
			<select name="id_salle" id="id_salle" class="form-control">
				<?php
				$query = $pdo->prepare('SELECT * FROM salle');
				$query->execute();
				$list = $query->fetchAll();
				foreach ($list as $row) {
					?><option <?php if($row['id_salle'] == $_POST['id_salle']){echo "selected";} ?> value="<?= $row['id_salle']; ?>"><?= $row["titre"] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-ls-6">
			<div class="form-group">
				<label>Date d'arrivée</label>
				<input type="text" class="form-control" name="date_arrivee" placeholder="Date d'arrivée" id="date_arrivee" value="<?= $_POST['date_arrivee'] ?>" required data-error="Vous devez choisir une date d'arrivée">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-ls-6">
			<div class="form-group">
				<label>Date de départ</label>
				<input type="text" class="form-control" name="date_depart" placeholder="Date de départ" id="date_depart" value="<?= $_POST['date_depart'] ?>" required data-error="Vous devez choisir une date de départ">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-ls-6">
			<div class="form-group">
				<label>Prix</label>
				<input type="text" class="form-control" name="prix" placeholder="Prix" id="prix" value="<?= $_POST['prix'] ?>" required data-error="Vous devez choisir un prix">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-ls-6">
			<div class="form-group">
				<label>Etat</label>
				<select name="etat" id="etat" class="form-control">
					<option <?php if($_POST['etat']=='libre'){echo "selected";} ?> value="libre">Libre</option>
					<option <?php if($_POST['etat']=='reserve'){echo "selected";} ?> value="reserve">Réservé</option>
				</select>
			</div>
		</div>
		<input type="submit" id="submitsalle" value="Je modifie le produit" class="btn btn-default">
	</form>