<?php
ob_start();
session_start();

$pagename="page produit";
include('menu.php'); 

$der_cmd = $pdo->prepare('
SELECT * FROM produit JOIN salle ON salle.id_salle=produit.id_salle                           
WHERE produit.id_produit=:idproduit');

$der_cmd->bindParam(':idproduit', $idproduit, PDO::PARAM_INT);
$der_cmd -> execute(); 
$cmd_list = $der_cmd->fetchAll(PDO::FETCH_ASSOC);

if($der_cmd->rowCount()==0){
    header('Location:'. $racines.'');
}else{ 
foreach($cmd_list as $row){
?>
    
<div class="container">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header col-lg-8">
						<?=$row['titre'];?>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
					</h1>
                     <div class="col-lg-4">
                        <?php 
                        if($row['etat']=='libre'){
                            if(isset($_SESSION['user'])){?>
                            <form method="POST" action="<?=$racines?>reserver_produit.php">
                                <input type="hidden" value="<?= $row['id_produit'] ?>" name="id_produit">
                                <input type="submit" class="btn btn-success" value="Réserver">
                            </form>
                       <?php }else{
                            echo '<a href=""  data-toggle="modal" data-target="#insciptionConnexion" class="btn btn-success">Réserver</a>'; 
                            }
                        }else{
                            echo '<p>Salle non disponible</p>';
                        }
                        ?>
                     </div>
                  
                   
     
                    
				</div>

				<div class="col-md-8">
					<img class="img-responsive" src="<?php echo $racines."images/".$row['photo']?>" alt="<?= $row['titre']; ?>">
				</div>

                <div class="col-md-4">
                    <h3>Description</h3>				
                    <?=$row['description'];?>

                    <h3>Localisation</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.04982597066!2d2.295621251593011!3d48.838188279183846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670155e708f7b%3A0xc1375b95f3fddee5!2s300+Rue+de+Vaugirard%2C+75015+Paris!5e0!3m2!1sen!2sfr!4v1492434024878" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                
            </div>
				<div class="row">

					<div class="col-lg-12">
						<h3 class="page-header">Informations complémentaires</h3>
					</div>

					<div class="col-sm-4 col-xs-4">
						
                            <p><span class="glyphicon glyphicon-calendar"></span> Arrivée : <?=date("d/m/Y", $row['date_arrivee']);?></p>
                            <p><span class="glyphicon glyphicon-calendar"></span> Départ : <?=date("d/m/Y", $row['date_depart']);?></p>
                 
					</div>

					<div class="col-sm-4 col-xs-4">
						<p><span class="glyphicon glyphicon-user"></span> Capacité : <?=$row['capacite'];?></p>
                            <p><span class="glyphicon glyphicon-inbox"></span> Catégorie : 

                            <?php if($row['categorie']=='1'){
                                echo "Réunion";
                              }elseif($row['categorie']=='2'){
                                echo "Bureau";
                              }else{
                                echo "Formation";
                              }
                            ?>
                            </p>
					</div>

					<div class="col-sm-4 col-xs-4">
						<p><span class="glyphicon glyphicon-map-marker"></span> Adresse : <?=$row['adresse'];?>, <?=$row['cp'];?>, <?=$row['ville'];?></p>
                            <p><span class="glyphicon glyphicon-euro"></span> Tarif : <?=$row['prix'];?> €</p>
					</div>

				</div>
				
				<div class="row">

					<div class="col-lg-12">
						<h3 class="page-header">Autres produits</h3>
					</div>

					
				<?php 
                $prod_rel = $pdo->prepare('
                SELECT * FROM commande
                LEFT JOIN produit ON produit.id_produit=commande.id_produit
                LEFT JOIN salle ON salle.id_salle=produit.id_salle                           
                WHERE salle.categorie=:categorie
                AND WHERE produit.id_produit!=:idproduit
                ORDER BY commande.date_enregistrement DESC');

                $prod_rel->bindParam(':categorie', $row['categorie'], PDO::PARAM_INT);
                $prod_rel->bindParam(':idproduit', $row['id_produit'], PDO::PARAM_INT);
                $prod_rel -> execute(); 
                $prod_list = $prod_rel->fetchAll(PDO::FETCH_ASSOC);
                      
                
                if($prod_rel->rowCount()==0){
                    echo '<div class="col-sm-12 col-xs-12">Il n\'y a pas de produits en relation</div>';
                }else{ 
                    foreach($prod_list as $list){?>
                        <div class="col-sm-3 col-xs-6">
                            <a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>">
                                <img class="img-responsive" src="<?php echo $racines."images/".$row['photo']?>" alt="<?= $row['titre']; ?>">
                            </a>
					    </div>

                   <?php }
                }?>
				
				</div>
			</div>
		</div>
	</div>

<?php }} ?>
	<?php
	include('footer.php');
	?>