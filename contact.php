<?php
session_start();
$pagename="contact";
include('menu.php'); ?>

<div class="container">
	<div class="row">
		Page avec formulaire de contact, envoi email à l'admin / s'il y a le temps ajout dans le back office de l'historique des mails et réponse dans l'admin

		Raison sociale : LOKISALLE
		Adresse : 300 Boulevard de Vaugirard, 75015 Paris, France

		<?php
		if(isset($_SESSION['profile'])){
			include('idprofil.php');
			if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos=$resultsql['pseudo'];
			if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email=$resultsql['email'];
		}else{
			if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos="";
			if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email="";
		}
		if(isset($_POST['objet'])) $objet=htmlspecialchars(addslashes($_POST['objet'])); else $objet="";
		if(isset($_POST['contenu'])) $contenu=htmlspecialchars(addslashes($_POST['contenu'])); else $contenu="";
		?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Contactez-nous
					</h1>
				</div>
				<div class="col-md-6 col-md-offset-3 col-centered">
					<form role="form" action="" name="contact" method="post" data-toggle="validator">
						<div class="form-group has-feedback" <?php if(isset($_SESSION['profile'])){echo'style="display:none;visibility:hidden;"';}else{} ?>>
							<label for="pseudo">Pseudo</label>
							<input type="text" class="form-control" name="infos" placeholder="Pseudo" value="<?php echo $infos; ?>" maxlength="200" required data-error="Vous devez écrire votre pseudo">
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group has-feedback" <?php if(isset($_SESSION['profile'])){echo'style="display:none;visibility:hidden;"';}else{} ?>>
							<label for="inputEmail">Email</label>
							<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php echo $email; ?>" maxlength="200" required data-error="Vous devez écrire un email valide">
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group has-feedback">
							<label for="objet">Objet</label>
							<input type="text" class="form-control" name="objet" placeholder="Objet" value="<?php echo $objet; ?>" maxlength="200" required data-error="Vous devez écrire un objet">
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group has-feedback">
							<label for="exampleInputPassword1">Description</label>
							<textarea name="contenu" class="form-control" rows="3" placeholder="Description" required data-error="Vous devez écrire un message"></textarea>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							<div class="help-block with-errors"></div>
						</div>
						<button type="submit" value="submit" class="btn btn-default">J'envoi le formulaire</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>