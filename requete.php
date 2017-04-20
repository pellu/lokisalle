<?php
require_once("config.php");

if($_POST){
	extract($_POST);

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$requete = "SELECT s.id_salle, p.id_produit, s.photo, s.titre, p.prix, s.description, s.ville, p.date_arrivee, p.date_depart
	FROM salle s, produit p
	
	WHERE p.id_salle = s.id_salle";
	
	if($_POST['capacite']){
		$requete .= " AND capacite >=".$_POST['capacite'];
	}
	if($_POST['categorie']){
		$requete .= " AND categorie =".$_POST['categorie'];
	}
	if($_POST['prix']){
		$requete .= " AND prix <=".$_POST['prix'];
	}
	if($_POST['ville']){
		$requete .= " AND ville ='".$_POST['ville']."'";
	}
	if($_POST['date_arrivee']){
		$requete .= " AND date_arrivee >='".$_POST['date_arrivee']."'";
	}
	if($_POST['date_depart']){
		$requete .= " AND date_depart <='".$_POST['date_depart']."'";
	}
	$requete .= " AND p.etat = 'libre' ORDER BY p.date_arrivee";

	$query = $pdo->prepare($requete);
	$query->execute();
	$list = $query->fetchAll();

	foreach ($list as $row) {
		if($row == 1){
			echo "Le site n'a pas encore de produits";
		}else{
			?>
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div class="thumbnail">
					<img src="<?= $racines; ?>images/<?= $row['photo']; ?>" alt="<?= $row['titre']; ?>">
					<div class="caption">
						<h4 class="pull-right"><?= $row['prix']; ?> €</h4>
						<h4><a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><?= $row['titre']; ?></a>
						</h4>
						<p><?= $row['description']; ?></p>
						<p>Du <?= $row['date_arrivee']; ?> au <?= $row['date_depart']; ?></p>
					</div>
					<div class="ratings">
						<p class="pull-right">15 reviews</p>
						<p>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
