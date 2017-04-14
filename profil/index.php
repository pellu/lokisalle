<?php
session_start();
$pagename="Profil";
include('../menu.php'); ?>

    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            Bonjour
                            <?= $resultsql['prenom'];?>
                                <?= $resultsql['nom'];?>, bienvenue sur votre profil
                        </h2>
                        <p>
                            Vous êtes inscrit depuis le
                            <?=
                            date("d/m/Y", $resultsql['date_enregistrement']);?>.
                        </p>
                    </div>
                    <img src="http://www.assuropoil.fr/wp-content/uploads/assurance-chat-assurer-son-chat.jpg" alt="photo de profil" class="col-lg-3">
                    <div class="col-md-6 col-centered">
                        <p>Pseudo<button class="glyphicon glyphicon-edit edit" aria-hidden="true"></button></p>
                        <p><?= $resultsql['pseudo'];?></p>
                        <p>Prénom<button class="glyphicon glyphicon-edit edit" aria-hidden="true"></button></p>
                        <p><?= $resultsql['prenom'];?></p>
                        <p>Nom<button class="glyphicon glyphicon-edit edit" aria-hidden="true"></button></p>
                        <p><?= $resultsql['nom'];?></p>
                        <p>Civilité<button class="glyphicon glyphicon-edit edit" aria-hidden="true"></button></p>
                        <p><?php
                            if ($resultsql['civilite'] == 'h') {
                                echo "Homme";
                            } elseif ($resultsql['civilite'] == 'f') {
                                echo "Femme";
                            } else {
                                echo "Autre";
                            }
                        ?></p>
                        <p>Mail<button class="glyphicon glyphicon-edit edit" aria-hidden="true"></button></p>
                        <p><?= $resultsql['email'];?></p>
                        
                        <button>Supprimer mon profil</button>
                    </div>
                    <div class="col-lg-12">
                        <h2 class="page-header">Vos dernières commandes :</h2>
                        
                        <?php 
                        
                            $der_cmd = $pdo->prepare('
                            SELECT * FROM commande
                            LEFT JOIN produit ON produit.id_produit=commande.id_produit
                            LEFT JOIN salle ON salle.id_salle=produit.id_salle                           
                            WHERE commande.id_membre=:userid
                            ORDER BY commande.date_enregistrement DESC');
                        
                            $der_cmd->bindParam(':userid', $_SESSION['userid'], PDO::PARAM_INT);
                            $der_cmd -> execute(); 
                            $cmd_list = $der_cmd->fetchAll(PDO::FETCH_ASSOC);
                        
                            //echo '<pre>';
                            //print_r($cmd_list);
                            //echo '</pre>';
                                
                            if($der_cmd->rowCount()==0){
                                echo 'Pas de commande faite !';  
                            }else{
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                
                           
                                    <?php foreach($cmd_list as $row){ ?>
                                    <div>
                                        <img src="#" alt="" class="col-lg-4">
                                        <div class="col-lg-8">
                                            <h3><?=$row['titre'];?></h3>
                                            <p><?=$row['description'];?></p>
                                            <button>Voir Salle</button>
                                        </div>
                                    </div>
                    
                                    <?php } ?>
                                   
                            </div>
                        </div>
                        <?php } ?>    
                    </div>
                </div>              
            </div>
        </div>
    </div>
    
<?php include('../footer.php'); ?>
