<?php
session_start();
$pagename="Qui sommes-nous ?";
include('menu.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Qui sommes-nous ?
			</h1>
		</div>
		<div class="col-md-10 col-md-offset-1 col-centered">
			<p>Lokisalle est un site qui loue des salles de réunion pour les entreprises. Derrière ce projet se cachent trois entrepreneurs, Magalie, Jordan et Erwin, dont la mission et la volonté sont de pouvoir aider les sociétés à rassembler leurs clients et leurs collaborateurs dans des locaux fonctionnels, élégants et modulables.</p>
			<img style="width: auto; margin-left: auto; margin-right: auto;" alt="C'est nous :)" src="<?=$racines?>img/quisommesnous.jpg">
		</div>
	</div>
</div>

<?php
include('footer.php');
?>