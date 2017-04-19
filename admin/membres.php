<?php
session_start();
$pagename="Membres";
include('menu.php');
?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Membres
        </h1>
      </div>
    </div>
    <?php
    $resultat=$pdo->query("SELECT * FROM membre");
    $membres=$resultat->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <style type="text/css">
      /* Cacher colonne mdp */
      th:nth-child(3), td:nth-child(3){
        display: none;
      }
    </style>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
        <div class="table-responsive">
          <table id="table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <?php for($i =0; $i < $resultat -> columnCount(); $i ++) : ?>
                  <?php $colonne = $resultat -> getColumnMeta($i); ?>

                  <th><?= $colonne['name'] ?></th>
                <?php endfor; ?>
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($membres as $indice => $valeur) : ?>
                <tr>
                  <?php foreach ($valeur as $indice2 => $valeur2) : ?>

                    <?php if($indice2 == 'civilite') : ?>
                      <td><?php
                        if($valeur2=='h'){
                          echo "Homme";
                        }elseif($valeur2=='f'){
                          echo "Femme";
                        }else{
                          echo "Autre";
                        } ?>
                      </td>
                    <?php elseif($indice2 == 'statut') : ?>
                      <td><?php
                        if($valeur2=='1'){
                          echo "Admin";
                        }elseif($valeur2=='2'){
                          echo "Désactivé";
                        }else{
                          echo "Utilisateur";
                        } ?></td>
                      <?php elseif($indice2 == 'date_enregistrement') : ?>
                        <td><?php
                          echo date("d/m/Y", $valeur2);
                          else : ?>
                          <td><?= $valeur2; ?></td>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      <td>

                        <a href="#" data-toggle="modal" data-target="#modalModif<?= $valeur['id_membre'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                        <div class="modal fade" id="modalModif<?= $valeur['id_membre'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modification du membre n° <?= $valeur['id_membre'] ?></h4>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="<?= $racinea ?>membres_modifier.php?id=<?= $valeur['id_membre'] ?>" data-toggle="validator" novalidate="true">
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group has-feedback">
                                      <label>Nom d'utilisateur</label>
                                      <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" id="pseudo" value="<?= $valeur['pseudo'] ?>" required data-error="Vous devez choisir un pseudo">
                                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group has-feedback">
                                      <label>Prénom</label>
                                      <input type="text" class="form-control" value="<?= $valeur['prenom'] ?>" placeholder="Prénom" id="prenom" name="prenom" required data-error="Vous devez écrire un Prénom">
                                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group has-feedback">
                                      <label>Nom</label>
                                      <input type="text" class="form-control" value="<?= $valeur['nom'] ?>" placeholder="Nom" id="nom" name="nom" required data-error="Vous devez écrire un Nom">
                                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group has-feedback">
                                      <label>Email</label>
                                      <input type="email" class="form-control" value="<?= $valeur['email'] ?>" id="email" placeholder="Email" name="email"  required data-error="Vous avez oublié d'indiquer votre mail">
                                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group">
                                      <label>Nouveau mot de passe <span class="small">(6 caract min.)</span></label>
                                      <input type="hidden" name="mdp_actuel" value="<?= $valeur['mdp'] ?>">
                                      <input type="password" class="form-control" id="password" value="" placeholder="Mot de passe" name="password">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-ls-6">
                                    <div class="form-group">
                                      <label for="civilite">Sexe</label>
                                      <select name="civilite" id="civilite" class="form-control">
                                        <option <?php if($valeur['civilite']=='h'){echo "selected";} ?> value="h">Homme</option>
                                        <option <?php if($valeur['civilite']=='f'){echo "selected";} ?> value="f">Femme</option>
                                        <option <?php if($valeur['civilite']=='a'){echo "selected";} ?> value="a">Autre</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Statut</label>
                                    <select name="statut" id="statut" class="form-control">
                                      <option <?php if($valeur['statut']==0){echo "selected";} ?> value="0">Utilisateur</option>
                                      <option <?php if($valeur['statut']==1){echo "selected";} ?> value="1">Admin</option>
                                      <option <?php if($valeur['statut']==2){echo "selected";} ?> value="2">Désactivé</option>
                                    </select>
                                  </div>
                                  <input type="submit" id="submitmembres" value="Je modifie le membre" class="btn btn-default">
                                </form>
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
    <script>$(document).ready(function() {
      $('.table').DataTable({
      //disable sorting on last column
      "columnDefs": [
      { "orderable": false, "targets": 9 }
      ],
      language: {
        'paginate': {
          'previous': '<span class="fa fa-chevron-left"></span>',
          'next': '<span class="fa fa-chevron-right"></span>',
        },
        //customize number of elements to be displayed
        "lengthMenu": 'Affichage <select class="form-control input-sm">'+
        '<option value="10">10</option>'+
        '<option value="20">20</option>'+
        '<option value="30">30</option>'+
        '<option value="40">40</option>'+
        '<option value="50">50</option>'+
        '<option value="-1">Tout</option>'+
        '</select> résultats'
      }
    })  
    } );
  </script>
  <?php include('footer.php'); ?>