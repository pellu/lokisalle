<?php
session_start();
$pagename="404";
include('menu.php'); ?>

<div class="container">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						ERREUR 404
					</h1>
				</div>
				<div class="col-md-12" style="text-align: center;">
					<div class="alert alert-danger"><strong>Vous êtes arrivé sur cette page car la page que vous avez essayé d'accéder n'existe pas ou plus ! Nous sommes maintenant informés de l'erreur !</div>
					<a href="<?=$racines?>"><img src="<?= $racines?>img/404.gif" alt="404"><br><br>
					Retourner à la page d'accueil</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>