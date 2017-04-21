<?php
session_start();
$pagename="Profil";
include('../menu.php');
if(empty($_SESSION['user'])){
	header('Location: '.$racines.'');
}
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">
        Bonjour
        <?= $resultsql['prenom'];?>
        <?= $resultsql['nom'];?>
        <span style="color: #666;font-weight: normal;font-size: 17px;">
          Vous êtes inscrit depuis le
          <?=date("d/m/Y", $resultsql['date_enregistrement']);?>
        </span>
      </div>
      <div class="col-lg-4">
        <h2 class="page-header">Vos informations</h2>
        <p class="intituler"><b>Pseudo</b> : <?= $resultsql['pseudo'];?><button class="btn-modif" type="button" data-toggle="modal" data-target="#modifierpseudo"><span class="glyphicon glyphicon-edit edit"></span></button></p>
        <p class="intituler"><b>Prénom</b> : <?= $resultsql['prenom'];?><button class="btn-modif" type="button" data-toggle="modal" data-target="#modifierprenom"><span class="glyphicon glyphicon-edit edit"></span></button></p>
        <p class="intituler"><b>Nom</b> : <?= $resultsql['nom'];?><button class="btn-modif" type="button" data-toggle="modal" data-target="#modifiernom"><span class="glyphicon glyphicon-edit edit"></span></button></p>

        <p class="intituler"><b>Civilité</b> : <?php if ($resultsql['civilite']=='h'){echo"Homme";}elseif($resultsql['civilite']=='f'){echo "Femme";}else{echo "Autre";}?><button class="btn-modif" type="button" data-toggle="modal" data-target="#modifiercivilite"><span class="glyphicon glyphicon-edit edit"></span></button></p>

        <p class="intituler"><b>Mail</b> : <?= $resultsql['email'];?><button class="btn-modif" type="button" data-toggle="modal" data-target="#modifiermail"><span class="glyphicon glyphicon-edit edit"></span></button></p>

        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modifiermdp">Modifer mon mot de passe</button><br><br>
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#supprimercompte">Supprimer mon profil</button>


      </div><br>
      <div class="col-lg-8">
        <?php 
        $der_cmd = $pdo->prepare('SELECT * FROM commande LEFT JOIN produit ON produit.id_produit=commande.id_produit LEFT JOIN salle ON salle.id_salle=produit.id_salle WHERE commande.id_membre=:userid ORDER BY commande.date_enregistrement DESC');
        $der_cmd->bindParam(':userid', $_SESSION['userid'], PDO::PARAM_INT);
        $der_cmd->execute();
        $cmd_list = $der_cmd->fetchAll(PDO::FETCH_ASSOC);
        $cmd_total = $der_cmd->rowCount();
        ?>
        <h2 class="page-header">Vos dernières commandes (<?php echo $cmd_total; ?>)</h2>

        <?php if($cmd_total==0){
          echo '<div class="alert alert-danger" role="alert">Vous n\'avez pas encore réalisé de commandes !</div>';  
        }else{
          foreach ($cmd_list as $row) {
            ?>
            <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail">
                <a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><img src="<?= $racines; ?>images/<?= $row['photo']; ?>" alt="<?= $row['titre']; ?>"></a>
                <div class="caption">
                  <h4 class="pull-right"><?= $row['prix']; ?> €</h4>
                  <h4><a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><?= $row['titre']; ?></a>
                  </h4>
                  <p><?= substr($row['description'], 0, 60); ?> ...</p>
                  <p>Du <?= $row['date_arrivee']; ?> au <?= $row['date_depart']; ?></p>
                </div>

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
            <?php }
          } ?>
        </div>
      </div>
    </div>

    <!-- MODAL PSEUDO -->
    <div class="modal fade" id="modifierpseudo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modifier le pseudo</h4>
          </div>
          <div class="modal-body">
            <div id="resultatpseudo"></div>
            <form method="POST" id="pseudo" data-toggle="validator">
              <div class="form-group has-feedback">
               <label>Pseudo</label>
               <input type="text" class="form-control" name="nouveaupseudo" placeholder="Nouveau pseudo" id="nouveaupseudo" value="" required data-error="Vous devez modifier votre pseudo">
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>
             <input type="submit" id="submitpseudo" value="Modifier le pseudo" class="btn btn-default">
           </form>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
           <script>
            $(document).ready(function(){
              $("#submitpseudo").click(function(e){
                e.preventDefault();
                $.post(
                  'traitement/modifier_pseudo.php',
                  {
                    nouveaupseudo: $('#nouveaupseudo').val()
                  },
                  function(data){
                    $("#resultatpseudo").html(data);
                  },
                  'text'
                  );
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL PRENOM -->
  <div class="modal fade" id="modifierprenom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modifier le prénom</h4>
        </div>
        <div class="modal-body">
          <div id="resultatprenom"></div>
          <form method="POST" id="prenom" data-toggle="validator">
            <div class="form-group has-feedback">
             <label>Prénom</label>
             <input type="text" class="form-control" name="nouveauprenom" placeholder="Nouveau prénom" id="nouveauprenom" value="" required data-error="Vous devez modifier votre prénom">
             <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
             <div class="help-block with-errors"></div>
           </div>
           <input type="submit" id="submitprenom" value="Modifier le prénom" class="btn btn-default">
         </form>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
         <script>
          $(document).ready(function(){
            $("#submitprenom").click(function(e){
              e.preventDefault();
              $.post(
                'traitement/modifier_prenom.php',
                {
                  nouveauprenom: $('#nouveauprenom').val()
                },
                function(data){
                  $("#resultatprenom").html(data);
                },
                'text'
                );
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
<!-- MODAL NOM -->
<div class="modal fade" id="modifiernom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modifier le nom</h4>
      </div>
      <div class="modal-body">
        <div id="resultatnom"></div>
        <form method="POST" id="nom" data-toggle="validator">
          <div class="form-group has-feedback">
           <label>Nom</label>
           <input type="text" class="form-control" name="nouveaunom" placeholder="Nouveau nom" id="nouveaunom" value="" required data-error="Vous devez modifier votre nom">
           <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
           <div class="help-block with-errors"></div>
         </div>
         <input type="submit" id="submitnom" value="Modifier le nom" class="btn btn-default">
       </form>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
       <script>
        $(document).ready(function(){
          $("#submitnom").click(function(e){
            e.preventDefault();
            $.post(
              'traitement/modifier_nom.php',
              {
                nouveaunom: $('#nouveaunom').val()
              },
              function(data){
                $("#resultatnom").html(data);
              },
              'text'
              );
          });
        });
      </script>
    </div>
  </div>
</div>
</div>
<!-- MODAL CIVILITE -->
<div class="modal fade" id="modifiercivilite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modifier sa civilité</h4>
      </div>
      <div class="modal-body">
        <div id="resultatcivilite"></div>
        <form method="POST" id="civilite" data-toggle="validator">
          <div class="form-group has-feedback">
           <label>Civilité</label>
           <select name="nouveaucivilite" id="nouveaucivilite" data-error="Vous devez modifier votre civilité" class="form-control">
            <option value="h" selected>Homme</option> 
            <option value="f">Femme</option>
            <option value="o">Autre</option>
          </select>
          <span class="glyphicon form-control-feedback" aria-hidden="true" style="left: 90%;"></span>
          <div class="help-block with-errors"></div>
        </div>
        <input type="submit" id="submitcivilite" value="Modifier la civilité" class="btn btn-default">
      </form>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script>
        $(document).ready(function(){
          $("#submitcivilite").click(function(e){
            e.preventDefault();
            $.post(
              'traitement/modifier_civilite.php',
              {
                nouveaucivilite: $('#nouveaucivilite').val()
              },
              function(data){
                $("#resultatcivilite").html(data);
              },
              'text'
              );
          });
        });
      </script>
    </div>
  </div>
</div>
</div>
<!-- MODAL MAIL -->
<div class="modal fade" id="modifiermail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modifier son mail</h4>
      </div>
      <div class="modal-body">
        <div id="resultatmail"></div>
        <form method="POST" id="mail" data-toggle="validator">
          <div class="form-group has-feedback">
           <label>Mail</label>
           <input type="text" class="form-control" name="nouveaumail" placeholder="Nouveau mail" id="nouveaumail" value="" required data-error="Vous devez modifier votre mail">
           <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
           <div class="help-block with-errors"></div>
         </div>
         <input type="submit" id="submitmail" value="Modifier votre mail" class="btn btn-default">
       </form>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
       <script>
        $(document).ready(function(){
          $("#submitmail").click(function(e){
            e.preventDefault();
            $.post(
              'traitement/modifier_mail.php',
              {
                nouveaumail: $('#nouveaumail').val()
              },
              function(data){
                $("#resultatmail").html(data);
              },
              'text'
              );
          });
        });
      </script>
    </div>
  </div>
</div>
</div>
<!-- MODAL MDP -->
<div class="modal fade" id="modifiermdp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modifier son mot de passe</h4>
      </div>
      <div class="modal-body">
        <div id="resultatmdp"></div>
        <form method="POST" id="mdp" data-toggle="validator">
          <div class="form-group has-feedback">
           <label>Mot de passe</label>
           <input type="password" class="form-control" name="nouveaumdp" placeholder="Nouveau mot de passe" id="nouveaumdp" value="" required data-error="Vous devez modifier votre mot de passe">
           <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
           <div class="help-block with-errors"></div>
         </div>
         <input type="submit" id="submitmdp" value="Modifier votre mot de passe" class="btn btn-default">
       </form>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
       <script>
        $(document).ready(function(){
          $("#submitmdp").click(function(e){
            e.preventDefault();
            $.post(
              'traitement/modifier_mdp.php',
              {
                nouveaumdp: $('#nouveaumdp').val()
              },
              function(data){
                $("#resultatmdp").html(data);
              },
              'text'
              );
          });
        });
      </script>
    </div>
  </div>
</div>
</div>
<!-- MODAL supprimer compte -->
<div class="modal fade" id="supprimercompte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Supprimer son compte</h4>
      </div>
      <div class="modal-body">
        <div id="resultatcompte"></div>
        <p>Voulez vous vraiment supprimer votre compte ?</p>
        <button id="supprimer" class="btn btn-default">OUI</button>
        <button id="refresh" class="btn btn-default">NON</button>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>
          $(document).ready(function(){
            $("#supprimer").click(function(e){location.href="../profil/traitement/supprimer_profil.php"});
            $("#refresh").click(function(e){location.reload();});
          });
        </script>
      </div>
    </div>
  </div>
</div>
<?php include('../footer.php'); ?>