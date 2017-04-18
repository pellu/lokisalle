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
										<th>Nb note</th>
										<th>Note moyenne</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
										$querysallenote = $pdo->prepare('
											SELECT * FROM produit
											LEFT JOIN salle ON salle.id_salle=produit.id_salle,
											LEFT JOIN avis ON avis.id_produit=produit.id_produit
											WHERE id_produit=13');
										$querysallenote->execute();
										$topsallenote = $querysallenote->fetchAll();
										foreach ($topsallenote as $row) {

											echo '<td>'.$row['id_salle'].'</td>';
										}
										?>
										
										<td>Salle ???</td>
										<td>Note ???</td>
										<td>Note moyenne ???</td>
									</tr>
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
									<tr>
										<td>Salle ???</td>
										<td>nb commandes ???</td>
									</tr>
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
									<tr>
										<td>pseudo ???</td>
										<td>quantité ???</td>
									</tr>
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
									<tr>
										<td>pseudo ???</td>
										<td>Montant ???</td>
									</tr>
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