<?php include('header.php'); ?>

<div id="wrapper">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?= $racines; ?>" class="navbar-brand"><img src="<?= $racines; ?>img/logo.svg" alt="logo" style="height:20px;"></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-left">
                <li <?php if($pagename=='Lokisalle' ){echo 'class="active"';}else{} ?>><a href="<?= $racines; ?>">Accueil</a></li>
				<li <?php if($pagename=='Qui sommes-nous ?'){echo 'class="active"';}else{} ?>><a href="<?= $racines; ?>quisommesnous/">Qui sommes nous ?</a></li>
				<li <?php if($pagename=='contact'){echo 'class="active"';}else{} ?>><a href="<?= $racines; ?>contact/">Contact</a></li>
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
                                    <a href="<?= $racinea; ?>">Admin</a>
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
                        <a href="" class="glyphicon glyphicon-user" data-toggle="modal" data-target="#insciptionConnexion">&nbsp;<span style="font-family:'Dosis',sans-serif; font-weight:900; font-size:14px;">Connexion</span></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
    </nav>
</div>