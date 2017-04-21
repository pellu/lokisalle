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

        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <style type="text/css">
                .btn-warning,.btn-warning:hover,.btn-warning:active:hover{
                    color: #fff;
                    background-color: #C1272D;
                    border-color: #C1272D;
                }
            </style>
            <script type="text/javascript">
                $(function(){
                    $('.rating-select .btn').on('mouseover', function(){
                        $(this).removeClass('btn-default').addClass('btn-warning');
                        $(this).prevAll().removeClass('btn-default').addClass('btn-warning');
                        $(this).nextAll().removeClass('btn-warning').addClass('btn-default');
                    });

                    $('.rating-select').on('mouseleave', function(){
                        active = $(this).parent().find('.selected');
                        if(active.length) {
                            active.removeClass('btn-default').addClass('btn-warning');
                            active.prevAll().removeClass('btn-default').addClass('btn-warning');
                            active.nextAll().removeClass('btn-warning').addClass('btn-default');
                        } else {
                            $(this).find('.btn').removeClass('btn-warning').addClass('btn-default');
                        }
                    });

                    $('.rating-select .btn').click(function(){
                        if($(this).hasClass('selected')) {
                            $('.rating-select .selected').removeClass('selected');
                        } else {
                            $('.rating-select .selected').removeClass('selected');
                            $(this).addClass('selected');
                        }
                    });
                });
            </script>

            <div class="rating-select">
                <div class="btn btn-default btn-sm"><span class="fa fa-star"></span></div>
                <div class="btn btn-default btn-sm"><span class="fa fa-star"></span></div>
                <div class="btn btn-default btn-sm"><span class="fa fa-star"></span></div>
                <div class="btn btn-default btn-sm"><span class="fa fa-star"></span></div>
                <div class="btn btn-default btn-sm"><span class="fa fa-star"></span></div>
            </div>

            <button type="submit" class="btn btn-warning" style="margin-top: 15px;">J'envoi mon avis</button>
        </form>
    </div>      
</div>
</div>
</div>
<?php
include('footer.php');
?>