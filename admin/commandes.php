<?php
session_start();
$pagename="Commandes";
include('menu.php');
?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Commandes
        </h1>
      </div>
    </div>
    <?php
    $resultat=$pdo->query("SELECT * FROM commande");
    $commandes=$resultat->fetchAll(PDO::FETCH_ASSOC);
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
              <?php foreach ($commandes as $indice => $valeur) : ?>
                <tr>
                  <?php foreach ($valeur as $indice2 => $valeur2) : ?>
                      <td><?= $valeur2; ?></td>
                  <?php endforeach; ?>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#modalSupprimer<?= $valeur['id_commande'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    <div class="modal fade" id="modalSupprimer<?= $valeur['id_commande'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Supprimer la commande n° <?= $valeur['id_commande'] ?></h4>
                          </div>
                          <div class="modal-body">
                          <a type="button" class="btn btn-danger" href="<?= $racinea ?>commandes_supprimer.php?id=<?= $valeur['id_commande'] ?>">Je valide la suppression de la commande n°<?= $valeur['id_commande'] ?></a>
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