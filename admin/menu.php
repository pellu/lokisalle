<?php
include('header.php'); ?>
<div id="wrapper">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $racinea; ?>">Admin Lokisalle</a>
		</div>
		<ul class="nav navbar-right top-nav">
			<li>
				<a href="<?= $racines; ?>"><i class="fa fa-fw fa-user"></i> Accès au site</a>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $resultsql['prenom'].' '. $resultsql['nom']; ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?= $racines; ?>profil/"><i class="fa fa-fw fa-user"></i> Mon profil</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?= $racines; ?>profil/deconnexion/"><i class="fa fa-fw fa-power-off"></i> Deconnexion</a>
					</li>
				</ul>
			</li>
		</ul>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li <?php if($pagename=='Accueil'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</li>
				<li <?php if($pagename=='Membres'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>membres/"><i class="fa fa-fw fa-desktop"></i> Membres</a>
				</li>
				<li <?php if($pagename=='Salles'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>salles/"><i class="fa fa-fw fa-bar-chart-o"></i> Salles</a>
				</li>
				<li <?php if($pagename=='Produits'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>produits/"><i class="fa fa-fw fa-edit"></i> Produits</a>
				</li>
				<li <?php if($pagename=='Commandes'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>commandes/"><i class="fa fa-fw fa-shopping-cart"></i> Commandes</a>
				</li>
				<li <?php if($pagename=='Avis'){echo 'class="active"';}else{} ?>>
					<a href="<?= $racinea; ?>avis/"><i class="fa fa-fw fa-comments"></i> Avis</a>
				</li>
			</ul>
		</div>
	</nav>