<?php include('header.php'); ?>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.html">Admin Lokisalle</a>
		</div>
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li>
				<a href="../index.php"><i class="fa fa-fw fa-user"></i> Accès au site</a>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-gear"></i> Paramètres</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#"><i class="fa fa-fw fa-power-off"></i> Deconnexion</a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li <?php if($pagename=='Accueil'){echo 'class="active"';}else{} ?>>
					<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</li>
				<li <?php if($pagename=='Salles'){echo 'class="active"';}else{} ?>>
					<a href="gestion_salles.php"><i class="fa fa-fw fa-bar-chart-o"></i> Salles</a>
				</li>
				<li <?php if($pagename=='Avis'){echo 'class="active"';}else{} ?>>
					<a href="gestion_avis.php"><i class="fa fa-fw fa-table"></i> Avis</a>
				</li>
				<li <?php if($pagename=='Produits'){echo 'class="active"';}else{} ?>>
					<a href="gestion_produits.php"><i class="fa fa-fw fa-edit"></i> Produits</a>
				</li>
				<li <?php if($pagename=='Membres'){echo 'class="active"';}else{} ?>>
					<a href="gestion_membres.php"><i class="fa fa-fw fa-desktop"></i> Membres</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>