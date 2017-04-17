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
          Produits
        </h1>
      </div>
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
                    <?php if($indice2 == 'photo') :
                            //Recherche le . dans le nom de l'image et le supprime avec ce qui se trouve après
                    $image = $valeur2;
                    $trouve_moi = ".";
                    $position = strpos($image, $trouve_moi);
                    $image_sans_extension = substr($image, 0, $position);
                    ?>
                    <td>
                      <a type="button" class="btn" data-toggle="modal" data-target="#modal<?= $image_sans_extension ?>"><img src="<?= $racine.'images/'.$valeur2 ?>" height="80"></a>
                      <div id="modal<?= $image_sans_extension ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $image_sans_extension ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-body">
                              <img src="<?= $racine.'images/'.$valeur2 ?>" class="img-responsive">
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  <?php elseif($indice2 == 'categorie') : ?>
                    <td><?php
                      if($valeur2=='1'){
                        echo "Réunion";
                      }elseif($valeur2=='2'){
                        echo "Bureau";
                      }else{
                        echo "Formation";
                      } else : ?>
                      <td><?= $valeur2; ?></td>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <td>

                    <a href="#" data-toggle="modal" data-target="#modalModif<?= $valeur['id_avis'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                    <div class="modal fade" id="modalModif<?= $valeur['id_avis'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modification de l'avis n° <?= $valeur['id_avis'] ?></h4>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="<?= $racinea ?>avis_modifier.php?id=<?= $valeur['id_avis'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
                             <div class="form-group has-feedback">
                               <label>Description</label>
                               <textarea class="form-control" id="commentaire" name="commentaire" required data-error="Vous devez ajouter un commentaire"><?= $valeur['commentaire'] ?></textarea>
                               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                               <div class="help-block with-errors"></div>
                             </div>
                             <input type="submit" id="submitavis" value="Je modifie l'avis" class="btn btn-default">
                           </div>
                         </form>
                       </div>
                     </div>
                   </div>
                 </div>
               </td>
               <td>
                <a href="#" data-toggle="modal" data-target="#modalSupprimer<?= $valeur['id_avis'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                <div class="modal fade" id="modalSupprimer<?= $valeur['id_avis'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Supprimer l'avis n° <?= $valeur['id_avis'] ?></h4>
                      </div>
                      <div class="modal-body">
                        <a type="button" class="btn btn-danger" href="<?= $racinea ?>avis_supprimer.php?id=<?= $valeur['id_avis'] ?>">Je valide la suppression de l'avis n°<?= $valeur['id_avis'] ?></a>
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