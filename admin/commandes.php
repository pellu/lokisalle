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
                <th colspan="1">Prix</th>
                <th colspan="2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($commandes as $indice => $valeur) : ?>
                <tr>
                  <?php foreach ($valeur as $indice2 => $valeur2) : ?>
                    <?php if($indice2 == 'id_commande') : ?>
                      <td><?php echo $valeur2; ?></td>
                    <?php elseif($indice2 == 'id_membre') : ?>
                      <td>
                      <?php //Affiche le pseudo de l'utilisateur en plus de son id
                      $query = $pdo->prepare('SELECT * FROM membre WHERE id_membre="'.$valeur2.'"');
                      $query->execute();
                      $list = $query->fetchAll();
                      foreach ($list as $row) {
                        echo $valeur2.' - '.$row['pseudo'];
                      } ?>
                    </td>
                  <?php elseif($indice2 == 'id_produit') : ?>
                    <td>
                      <?php
                      $queryb = $pdo->prepare('SELECT * FROM produit WHERE id_produit="'.$valeur['id_produit'].'"');
                      $queryb->execute();
                      $listb = $queryb->fetchAll();
                      foreach ($listb as $row) {
                        $queryc = $pdo->prepare('SELECT * FROM salle WHERE id_salle="'.$row['id_salle'].'"');
                        $queryc->execute();
                        $listc = $queryc->fetchAll();
                        foreach ($listc as $rowc) {
                          echo $valeur2.' - '.$rowc['titre'].'<br>'.$row['date_arrivee'].' au '.$row['date_depart'];
                        }
                      }
                      ?>
                    </td>
                  <?php else : ?>
                    <td><?= $valeur2; ?></td>
                  <?php endif; ?>
                <?php endforeach; ?>
                <td>
                  <?php
                  $querya = $pdo->prepare('SELECT * FROM produit WHERE id_produit="'.$valeur['id_produit'].'"');
                  $querya->execute();
                  $lista = $querya->fetchAll();
                  foreach ($lista as $row) {
                    echo $row['prix'].' €';
                  } ?>
                </td>
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

<script>$(document).ready(function() {
    $('.table').DataTable({
      //disable sorting on last column
      "columnDefs": [
        { "orderable": false, "targets": 5 }
      ],
      language: {
        'paginate': {
          'previous': '<span class="fa fa-chevron-left"></span>',
          'next': '<span class="fa fa-chevron-right"></span>'
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