<?php
require_once("config.php");

if($_POST){
	extract($_POST);

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

	//Compter nombre de résultat
	$nRows = $query->rowCount();
?>
<p>Votre recherche affiche <?php echo $nRows; ?> produit<?php if($nRows >= 2){echo "s";}?> disponible actuellement</p>
<?php
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
						<div class="ratings">
							<p class="pull-right">
								<?php
								$totalavis = $pdo -> query("SELECT COUNT(note) AS totalnote FROM avis WHERE id_salle='".$row['id_salle']."'");
								$totalavis->execute();
								$nbavis = $totalavis->fetchAll();                                               

								foreach ($nbavis as $rowa) {
									if($rowa['totalnote']==0){

									}else{
										echo $rowa['totalnote'].' avis';
									}
								}
								?>
							</p>
							<p>
								<?php
								$resultatavis = $pdo -> query("SELECT AVG(note) AS moyenne FROM avis WHERE id_salle='".$row['id_salle']."'");
								$resultatavis->execute();
								$topavis = $resultatavis->fetchAll();                                               

								foreach ($topavis as $rowb) {

									if(round($rowb['moyenne'])== 0) {
										echo 'Pas de note pour la salle';
									}elseif (round($rowb['moyenne']) == 1) {
										echo '<i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
									}elseif (round($rowb['moyenne']) == 2) {
										echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"> </i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
									}elseif (round($rowb['moyenne']) == 3) {
										echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
									}elseif (round($rowb['moyenne']) == 4) {
										echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>';
									}else{
										echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
									}
								}
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
