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
                      } ?>
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
                              <form method="POST" action="<?= $racinea ?>avis_modifier.php?id=<?= $valeur['id_membre'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
                               <div class="form-group has-feedback">
                                 <label>Description</label>
                                 <textarea class="form-control" id="commentaire" name="commentaire" required data-error="Vous devez ajouter un commentaire"><?= $valeur['commentaire'] ?></textarea>
                                 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                 <div class="help-block with-errors"></div>
                               </div>
                               <input type="submit" id="submitavis" value="Je modifie le membre" class="btn btn-default">
                             </div>
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
<?php include('footer.php'); ?>