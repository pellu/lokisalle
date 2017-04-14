<?php include('header.php'); ?>
<!-- Navigation -->

<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?= $racines; ?>" class="navbar-brand"><img src="<?= $racines; ?>img/logo.svg" alt="logo" style="height:20px;"></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-left">
                <li <?php if($pagename=='Lokisalle' ){echo 'class="active"';}else{} ?>><a href="<?= $racines; ?>">Accueil</a></li>
				<li <?php if($pagename=='Qui sommes-nous ?'){echo 'class="active"';}else{} ?>><a href="<?= $racines; ?>quisommesnous/">Qui sommes nous ?</a></li>
				<li><a href="<?= $racines; ?>contact/">Contact</a></li>
				<?php
				if(isset($_SESSION['user'])){
					?>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li <?php if($pagename=='Profil'){echo 'class="active"';}else{} ?>>
								<a href="<?= $racines; ?>profil/">Mon profil</a>
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
                                ?>
							<li>
								<a href="<?= $racines; ?>profil/deconnexion/">Deconnexion</a>
							</li>
						</ul>
					</li>
					<?php
					

				}else{
					?>
					<li>
						<a href="" class="glyphicon glyphicon-user" data-toggle="modal" data-target="#insciptionConnexion"></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
    </nav>
</div>