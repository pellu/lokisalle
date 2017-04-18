<?php
session_start();
$pagename="Accueil";
include('menu.php');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Statistiques
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-fw fa-comment"></i> Top 5 des salles les mieux notées</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Salle</th>
										<th>Note moyenne</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$resultat = $pdo -> query("SELECT s.titre, AVG(a.note) as moyenne from salle s, avis a where s.id_salle = a.id_salle group by s.titre LIMIT 5");
									$resultat->execute();
									$topresultat = $resultat->fetchAll();

									foreach ($topresultat as $row) {
										echo '<tr><td>'.$row['titre'].'</td>';
										echo '<td>'.$row['moyenne'].'</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-fw fa-sort-amount-desc"></i> Top 5 des salles les plus commandées</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Salle</th>
										<th>Nombre de commandes</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
									$resultat2 = $pdo -> query("SELECT count(c.id_commande) as nombre_de_reservation, s.titre FROM commande c, salle s, produit p where s.id_salle = p.id_salle AND p.id_produit = c.id_produit GROUP BY s.id_salle LIMIT 5");
									$resultat2->execute();
									$topresultat2 = $resultat2->fetchAll();

									foreach ($topresultat2 as $row) {
										echo '<tr><td>'.$row['titre'].'</td>';
										echo '<td>'.$row['nombre_de_reservation'].'</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-fw  fa-shopping-cart"></i> Top 5 des membres qui achètent le plus (en termes de quantité)</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Pseudo</th>
										<th>Quantité</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$resultat3 = $pdo -> query("SELECT count(*) as quantite, m.pseudo from commande c, produit p, membre m where c.id_membre = m.id_membre AND p.id_produit = c.id_produit group by m.id_membre LIMIT 5");
									$resultat3->execute();
									$topresultat3 = $resultat3->fetchAll();

									foreach ($topresultat3 as $row) {
										echo '<tr><td>'.$row['pseudo'].'</td>';
										echo '<td>'.$row['quantite'].'</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Top 5 des membres qui achètent le plus cher (en termes de prix)</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Pseudo</th>
										<th>Montant</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$resultat4 = $pdo -> query("SELECT m.pseudo, sum(p.prix) as prixTotal from produit p, membre m, commande c where p.id_produit = c.id_produit and c.id_membre = m.id_membre group by m.pseudo LIMIT 5");
									$resultat4->execute();
									$topresultat4 = $resultat4->fetchAll();

									foreach ($topresultat4 as $row) {
										echo '<tr><td>'.$row['pseudo'].'</td>';
										echo '<td>'.$row['prixTotal'].'</td></tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>