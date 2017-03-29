<?php include('header.php'); ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Lokisalle</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?php if($pagename=='Lokisalle'){echo 'class="active"';}else{} ?>><a href="index.php">Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catégories <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Réunion</a></li>
						<li><a href="#">Bureau</a></li>
						<li><a href="#">Formation</a></li>
					</ul>
				</li>
				<li <?php if($pagename=='Qui sommes-nous ?'){echo 'class="active"';}else{} ?>><a href="quisommesnous.php">Qui sommes nous ?</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
			<?php
			if(isset($_SESSION['membre'])){
			?>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">Profil</a>
				</li>
				<li <?php if($pagename=='Paramètres'){echo 'class="active"';}else{} ?>>
					<a href="#">Parametres</a>
				</li>
				<li>
					<a href="#">Deconnexion</a>
				</li>
				<?php
				if($levelstatut=='1'){
					?>
					<li>
						<a href="#">Admin</a>
					</li>
					<?php
				}else{
		            //Pas de bouton admin vu que l'utilisateur n'es pas admin
				}
			}else{
			?>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">Inscription</a>
				</li>
				<li>
					<a href="#">Connexion</a>
				</li>
			</ul>
			<?php
			}
			?>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</nav>