<?php
session_start();
$pagename="Produits";
include('menu.php');
?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Produit <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAjout" aria-expanded="false" aria-controls="collapseAjout">Ajouter un produit</button>
        </h1>
      </div>
    </div>
    <?php
    $msg="";
    if($_POST){
      if(empty($_POST['id_salle'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez choisir une salle !</div>';
      }
      if(empty($_POST['date_arrivee'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez choisir une date d\'arrivée.</div>';
      }

      if(empty($_POST['date_depart'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez choisir une date de depart.</div>';
      }

      if(empty($_POST['prix'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter un prix.</div>';
      }

      if(!is_numeric($_POST['prix'])){  
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Chiffres seulement acceptés pour le prix.</div>';
      }  

      if(empty($_POST['etat'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez choisir un état.</div>';
      }

      if(empty($msg)){
        $resultat = $pdo -> prepare("INSERT INTO produit (id_salle, date_arrivee, date_depart, prix, etat) VALUES (:id_salle, :date_arrivee, :date_depart, :prix, :etat)");

        $resultat -> bindValue(':id_salle', $_POST['id_salle'], PDO::PARAM_STR);
        $resultat -> bindValue(':date_arrivee', $_POST['date_arrivee'], PDO::PARAM_STR);
        $resultat -> bindValue(':date_depart', $_POST['date_depart'], PDO::PARAM_STR);
        $resultat -> bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
        $resultat -> bindValue(':etat', $_POST['etat'], PDO::PARAM_STR);

        if($resultat -> execute()){
          ?>
          <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Succès!</strong> L'ajout du produit est ok.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
          </div>
          <?php
        }
      }

    }

    echo $msg;
    if(isset($_POST['id_salle'])) { $id_salle = $_POST['id_salle']; }else{ $id_salle = ''; }
    if(isset($_POST['date_arrivee'])) { $date_arrivee = $_POST['date_arrivee']; }else{ $date_arrivee = ''; }
    if(isset($_POST['date_depart'])) { $date_depart = $_POST['date_depart']; }else{ $date_depart = ''; }
    if(isset($_POST['prix'])) { $prix = $_POST['prix']; }else{ $prix = ''; }
    if(isset($_POST['etat'])) { $etat = $_POST['etat']; }else{ $etat = ''; }
    
    ?>
    <div class="collapse" id="collapseAjout">
      <form method="POST" id="ajout" data-toggle="validator" class="well">
        <div class="col-lg-12 col-md-12 col-ls-12">
          <div class="form-group">
            <label>Choix de la salle</label>
            <select name="id_salle" id="id_salle" class="form-control">
              <?php
              $query = $pdo->prepare('SELECT * FROM salle');
              $query->execute();
              $list = $query->fetchAll();
              foreach ($list as $row) {
                echo '<option value="'.$row["id_salle"].'">'.$row["titre"].'</option>';
              } ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-ls-6">
          <div class="form-group">
            <label>Date d'arrivée</label>
            <input type="text" class="form-control" name="date_arrivee" placeholder="Date d'arrivée" id="date_arrivee" value="<?= $date_arrivee ?>" required data-error="Vous devez choisir une date d'arrivée">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-ls-6">
          <div class="form-group">
            <label>Date de départ</label>
            <input type="text" class="form-control" name="date_depart" placeholder="Date de départ" id="date_depart" value="<?= $date_depart ?>" required data-error="Vous devez choisir une date de départ">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-ls-6">
          <div class="form-group">
            <label>Prix</label>
            <input type="text" class="form-control" name="prix" placeholder="Prix" id="prix" value="<?= $prix ?>" required data-error="Vous devez choisir un prix">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-ls-6">
          <div class="form-group">
            <label>Etat</label>
            <input type="text" class="form-control" name="etat" placeholder="Etat" id="etat" value="<?= $etat ?>" required data-error="Vous devez choisir un état">
          </div>
        </div>
        <input type="submit" id="submitproduit" value="J'ajoute le produit" class="btn btn-default">
      </form>
    </div>

    <?php
    $resultat=$pdo->query("SELECT * FROM produit");
    $produits=$resultat->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <?php for($i =0; $i < $resultat -> columnCount(); $i ++) : ?>
                  <?php $colonne = $resultat -> getColumnMeta($i); ?>
                  <th><?= $colonne['name'] ?></th>
                <?php endfor; ?>
                <th colspan="2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($produits as $indice => $valeur) : ?>
                <tr>
                  <?php foreach ($valeur as $indice2 => $valeur2) : ?>
                    <?php if($indice2 == 'id_salle') : ?>
                      <td>
                        <?php
                        //Affiche la salle en plus de son id
                        $querysalle = $pdo->prepare('SELECT * FROM salle WHERE id_salle="'.$valeur2.'"');
                        $querysalle->execute();
                        $listsalle = $querysalle->fetchAll();
                        foreach ($listsalle as $rowsalle) {
                          echo $valeur2.' - '.$rowsalle['titre'];
                        } ?>
                      </td>

                    <?php elseif($indice2 == 'prix') : ?>
                      <td>
                        <?php
                        echo $valeur2.' €';
                        ?>
                      </td>
                    <?php else : ?>
                      <td><?= $valeur2; ?></td>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <td>

                    <a href="#" data-toggle="modal" data-target="#modalModif<?= $valeur['id_salle'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                    <div class="modal fade" id="modalModif<?= $valeur['id_salle'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modification du produit n° <?= $valeur['id_produit'] ?></h4>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="<?= $racinea ?>salles_modifier.php?id=<?= $valeur['id_salle'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
                              <div class="col-lg-12 col-md-12 col-ls-12">
                                <div class="form-group">
                                  <label>Choix de la salle</label>
                                  <select name="id_salle" id="id_salle" class="form-control">
                                    <?php
                                    $query = $pdo->prepare('SELECT * FROM salle');
                                    $query->execute();
                                    $list = $query->fetchAll();
                                    foreach ($list as $row) {
                                      echo '<option value="'.$row["id_salle"].'">'.$row["titre"].'</option>';
                                    } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-ls-6">
                                <div class="form-group">
                                  <label>Date d'arrivée</label>
                                  <input type="text" class="form-control" name="date_arrivee" placeholder="Date d'arrivée" id="date_arrivee" value="<?= $valeur['date_arrivee'] ?>" required data-error="Vous devez choisir une date d'arrivée">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-ls-6">
                                <div class="form-group">
                                  <label>Date de départ</label>
                                  <input type="text" class="form-control" name="date_depart" placeholder="Date de départ" id="date_depart" value="<?= $valeur['date_depart'] ?>" required data-error="Vous devez choisir une date de départ">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-ls-6">
                                <div class="form-group">
                                  <label>Prix</label>
                                  <input type="text" class="form-control" name="prix" placeholder="Prix" id="prix" value="<?= $valeur['prix'] ?>" required data-error="Vous devez choisir un prix">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-ls-6">
                                <div class="form-group">
                                  <label>Etat</label>
                                  <input type="text" class="form-control" name="etat" placeholder="Etat" id="etat" value="<?= $valeur['etat'] ?>" required data-error="Vous devez choisir un état">
                                </div>
                              </div>
                            <input type="submit" id="submitsalle" value="Je modifie la salle" class="btn btn-default">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#modalSupprimer<?= $valeur['id_produit'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                  <div class="modal fade" id="modalSupprimer<?= $valeur['id_produit'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Supprimer la salle n° <?= $valeur['id_produit'] ?></h4>
                        </div>
                        <div class="modal-body">
                          <a type="button" class="btn btn-danger" href="<?= $racinea ?>salles_supprimer.php?id=<?= $valeur['id_produit'] ?>">Je valide la suppression de la salle n°<?= $valeur['id_produit'] ?></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php include('footer.php'); ?>