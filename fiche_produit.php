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
                              <?php
                              $resultatavis = $pdo -> query("SELECT AVG(note) AS moyenne FROM avis WHERE id_salle='".$row['id_salle']."'");
                              $resultatavis->execute();
                              $topavis = $resultatavis->fetchAll();                                               

                              foreach ($topavis as $rowb) {
                                echo '<span style="font-size:18px;">';
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
                                echo "</span>";
                            }
                            ?>
                        </h1>
                        <div class="col-lg-4">
                            <?php 
                            if($row['etat']=='libre'){
                                if($row['date_arrivee'] <= date('d-m-Y')){
                                    echo "<p>La date de location est dépassée</p>";
                                }else{
                                    if(isset($_SESSION['user'])){?>
                                    <form method="POST" action="<?=$racines?>reserver_produit.php">
                                        <input type="hidden" value="<?= $row['id_produit'] ?>" name="id_produit">
                                        <input type="submit" class="btn btn-success" value="Réserver">
                                    </form>
                                    <?php }else{
                                        echo '<a href=""  data-toggle="modal" data-target="#insciptionConnexion" class="btn btn-success">Réserver</a>'; 
                                    }
                                }
                            }else{
                                $test = $pdo -> query("SELECT * FROM commande WHERE id_produit='".$row['id_produit']."'");
                                $test->execute();
                                $nbavis = $test->fetchAll();

                                foreach($nbavis as $rowb){
                                    if(isset($_SESSION['user'])){
                                        if($_SESSION['userid']==$rowb['id_membre']){
                                            echo "<p>Vous avez déjà réservé ce produit</p>";
                                        }else{
                                            echo '<p>Produit déjà réservé</p>';
                                        }
                                    }else{
                                        echo '<p>Produit déjà réservé</p>';
                                    }
                                }
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
                    <div id="map"></div>
                    <style>#map {height: 300px;}</style>
                    <?php
                        // On prépare l'adresse à rechercher
                    $address = $row['adresse'].' '.$row['cp'].' '.$row['ville'];
                        // On prépare l'URL du géocodeur
                    $geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";
                        // Pour cette exemple, je vais considérer que ma chaîne n'est pas
                        // en UTF8, le géocoder ne fonctionnant qu'avec du texte en UTF8
                    $url_address = utf8_encode($address);
                        // Penser a encoder votre adresse
                    $url_address = urlencode($url_address);
                        // On prépare notre requête
                    $query = sprintf($geocoder,$url_address);
                        // On interroge le serveur
                    $results = file_get_contents($query);
                        // On affiche le résultat
                    $result = json_decode($results);

                    $lat = $result->results[0]->geometry->location->lat;
                    $lon = $result->results[0]->geometry->location->lng;
                    ?>

                    <script>
                      var map;
                      function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: <?= $lat ?>, lng: <?= $lon ?>},
                          zoom: 15
                      });
                        var myLatlng = new google.maps.LatLng(<?= $lat ?>,<?= $lon ?>);
                        var marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe6qiRuxyCMUJOC2FQfwh9gEZ9UEskfhE&callback=initMap" async defer></script>
            </div>
        </div>
        <div class="row">

           <div class="col-lg-12"><br>
              <h3 class="page-header">Informations complémentaires</h3>
          </div>

          <div class="col-sm-4 col-xs-4">

            <p><span class="glyphicon glyphicon-calendar"></span> Arrivée : <?=$row['date_arrivee'];?></p>
            <p><span class="glyphicon glyphicon-calendar"></span> Départ : <?=$row['date_depart'];?></p>

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
        AND produit.id_produit!=:idproduit
        AND produit.date_arrivee>=:datedujour
        ORDER BY commande.date_enregistrement DESC LIMIT 0,4');

    $prod_rel->bindValue(':datedujour', date('d-m-Y'), PDO::PARAM_STR);
    $prod_rel->bindParam(':categorie', $row['categorie'], PDO::PARAM_STR);
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

<?php }} ?>
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <h3 class="page-header">Laisser un avis
            <span style="color:grey;font-size: 15px;font-weight: normal;">
                <?php
                $totalavis = $pdo -> query("SELECT COUNT(note) AS totalnote FROM avis WHERE id_salle='".$row['id_salle']."'");
                $totalavis->execute();
                $nbavis = $totalavis->fetchAll();

                foreach ($nbavis as $rowa) {
                    if($rowa['totalnote']==0){
                        echo "Il n'y a pas encore d'avis";
                    }else{
                        echo 'Il y a déjà '.$rowa['totalnote'].' avis déposés';
                    }
                }
                ?>
            </span>
        </h3>
    </div>
    <div class="col-lg-12">
        <?php if(isset($_SESSION['user'])){ ?>
        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <style type="text/css">
                .select-rating-stars, .select-rating-stars label::before{
                    display: inline-block;
                }

                .select-rating-stars label:hover, .select-rating-stars label:hover ~ label{
                    color: red;
                }

                .select-rating-stars *{
                    margin: 0;
                    padding: 0;
                }

                .select-rating-stars input{
                    display: none;
                }

                .select-rating-stars{
                    unicode-bidi: bidi-override;
                    direction: rtl;
                }

                .select-rating-stars label{
                    color: #ccc;
                }

                .select-rating-stars label::before{
                    content: "\2605";
                    width: 18px;
                    line-height: 18px;
                    text-align: center;
                    font-size: 18px;
                    cursor: pointer;
                }

                .select-rating-stars input:checked ~ label{
                    color: #C1272D;
                }

                .select-rating-disabled{
                    opacity: .50;
                    -webkit-pointer-events: none;
                    -moz-pointer-events: none;
                    pointer-events: none;
                }
            </style>

            <div class="select-rating-stars">
                <form>
                    <input type="radio" name="group-1" id="group-1-0" value="5" /><label for="group-1-0"></label>
                    <input type="radio" name="group-1" id="group-1-1" value="4" /><label for="group-1-1"></label>
                    <input type="radio" name="group-1" id="group-1-2" value="3" /><label for="group-1-2"></label>
                    <input type="radio" name="group-1" id="group-1-3" value="2" /><label for="group-1-3"></label>
                    <input type="radio" name="group-1" id="group-1-4"  value="1" /><label for="group-1-4"></label>
                </form>
            </div>
            <button type="submit" class="btn btn-default" style="margin-top: 15px;">J'envoi mon avis</button>
        </form>
    </div>
    <div class="col-lg-12">
        <h3 class="page-header">Avis déposés</h3>
        <?php
        $requeteavis = $pdo -> query("SELECT * FROM avis INNER JOIN membre ON membre.id_membre=avis.id_membre WHERE id_salle='".$row['id_salle']."'");
        $requeteavis->execute();
        $affichageavis = $requeteavis->fetchAll();
        if($rowa['totalnote']==0){
            echo "<p>Il n'y a pas encore d'avis pour la salle</p>";
        }
        ?>

        <?php }else{echo '<a href=""  data-toggle="modal" data-target="#insciptionConnexion" class="btn btn-success">Veuillez vous connecter pour donner votre avis</a>';} ?><br>
        <?php

        foreach ($affichageavis as $rowavis) {
            ?>
            <div style="margin-top: 5px;">
                Le membre <b><?= $rowavis['pseudo']; ?></b> donne une note de <b><?= $rowavis['note']; ?>/5</b> avec comme commentaire : <?= $rowavis['commentaire']; ?>
            </div>
            <?php
        }
        ?>
    </div>




</div>
</div>
</div>
<?php
include('footer.php');
?>