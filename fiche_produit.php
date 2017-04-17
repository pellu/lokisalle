<?php
session_start();
$pagename="produit ???";
include('menu.php'); ?>

<div class="container">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Nom du produit
					</h1>
				</div>

				<div class="col-md-8">
					<img class="img-responsive" src="http://placehold.it/750x500" alt="">
				</div>

				<div class="col-md-4">
					<h3>Project Description</h3>
					<p>Informations complétes sur le produit

						Titre - Notation (etoiles) - Bouton réserver

						Photo - Description - Localisation (maps)

						Informations complémentairs : Arrivée/départ/capacité/catégorie/adresse/prix

						Autres produits:
						Produits de la même catégorie - Affichage prix, capacité, adresse, arrivée/départ

						Déposer un commentaire et une note

						Seulement connecté : Case commentaire/select étoiles -> submit</p>
						<h3>Project Details</h3>
						<ul>
							<li>Lorem Ipsum</li>
							<li>Dolor Sit Amet</li>
							<li>Consectetur</li>
							<li>Adipiscing Elit</li>
						</ul>
					</div>

				</div>
				<div class="row">

					<div class="col-lg-12">
						<h3 class="page-header">Related Projects</h3>
					</div>

					<div class="col-sm-3 col-xs-6">
						<a href="#">
							<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
						</a>
					</div>

					<div class="col-sm-3 col-xs-6">
						<a href="#">
							<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
						</a>
					</div>

					<div class="col-sm-3 col-xs-6">
						<a href="#">
							<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
						</a>
					</div>

					<div class="col-sm-3 col-xs-6">
						<a href="#">
							<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
						</a>
					</div>

				</div>
				<div class="col-md-6 col-md-offset-3 col-centered">
				</div>
			</div>
		</div>
	</div>
	<?php
	include('footer.php');
	?>