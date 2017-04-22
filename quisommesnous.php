<?php
session_start();
$pagename="Qui sommes-nous ?";
include('menu.php'); ?>

<div class="container">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Qui sommes-nous ?
					</h1>
				</div>
				<div class="col-md-10 col-md-offset-1 col-centered">
                    <p>Lokisalle est une entreprise qui loue des salles de réunion pour les entreprises. Derrière ce projets se cachent trois entrepreneurs, Magalie Broye, Jordan Pellu et Erwin Schwartz, dont la mission et la volonté sont de pouvoir aider les sociétés à rassembler leurs clients et leurs collaborateurs dans des locaux fonctionnels, élégants et modulables.</p>
                    <img style="width: auto; margin-left: auto; margin-right: auto;" src="<?=$racines?>img/quisommesnous.jpg">
                </div>
			</div>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>