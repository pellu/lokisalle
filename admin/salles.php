<?php
$pagename="Salles";
include('menu.php');
?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Salles <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAjout" aria-expanded="false" aria-controls="collapseAjout">
          Ajouter une salle
        </button>
      </h1>
    </div>
  </div>
  <?php
  $msg="";
  if($_POST){
    if(empty($_POST['titre'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un nom de salle !</div>';
    }
    if(empty($_POST['description'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une description.</div>';
    }

    if(empty($_POST['ville'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une ville.</div>';
    }

    if(empty($_POST['adresse'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une adresse.</div>';
    }

    if(empty($_POST['codepostal'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter un codepostal.</div>';
    }

    if(empty($_POST['capacite'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une capacite.</div>';
    }
    if (!is_numeric($_POST['capacite'])){  
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Chiffres seulement acceptés pour la Capacité.</div>';
    }    

    //Génération de l'url aléatoire pour l'image
    function random($str) {
      $string = "";
      $url = "abcdefghijklmnpqrstuvwxy0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      srand((double)microtime()*1000000);
      for($i=0; $i<$str; $i++) {
        $string .= $url[rand()%strlen($url)];
      }
      return $string;
    }
    $url = random(10);

    $nom_photo='default.jpg';

    $element = pathinfo($_FILES['photo']['name']);

    if(empty($_FILES['photo']['name'])){
      $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez ajouter une photo.</div>';
    }else{
      $nom_photo=$url.'_'.$_SESSION['user'].'_'.time().'.'.$element['extension'];

      $chemin_photo= RACINE_SERVEUR.$racine.'images/'.$nom_photo;
      copy($_FILES['photo']['tmp_name'], $chemin_photo);
    }

    if(empty($msg)){
      $date_enregistrement=time();
      $resultat = $pdo -> prepare("INSERT INTO salle (titre, description, photo, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :ville, :adresse, :cp, :capacite, :categorie)");

      $resultat -> bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
      $resultat -> bindValue(':description', $_POST['description'], PDO::PARAM_STR);
      $resultat -> bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
      $resultat -> bindValue(':photo', $nom_photo, PDO::PARAM_STR);
      $resultat -> bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
      $resultat -> bindValue(':cp', $_POST['codepostal'], PDO::PARAM_INT);
      $resultat -> bindValue(':capacite', $_POST['capacite'], PDO::PARAM_INT);
      $resultat -> bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);

      if($resultat -> execute()){
        ?>
        <div class="alert alert-success fade in">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong>Succès!</strong> L'ajout de la salle est ok.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
        </div>
        <?php
      }
    }
  }
  if(isset($_POST['titre'])) { $titre = $_POST['titre']; }else{ $titre = ''; }
  if(isset($_POST['description'])) { $description = $_POST['description']; }else{ $description = ''; }
  if(isset($_POST['adresse'])) { $adresse = $_POST['adresse']; }else{ $adresse = ''; }
  if(isset($_POST['capacite'])) { $capacite = $_POST['capacite']; }else{ $capacite = ''; }
  echo $msg;
  ?>
  <div class="collapse" id="collapseAjout">
    <form method="POST" id="ajout" data-toggle="validator" class="well" enctype="multipart/form-data">
      <div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
        <div class="form-group has-feedback">
         <label>Titre</label>
         <input type="text" class="form-control" name="titre" placeholder="Titre" id="titre" value="<?= $titre ?>" required data-error="Vous devez ajouter un titre">
         <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
         <div class="help-block with-errors"></div>
       </div>
       <div class="form-group has-feedback">
         <label>Description</label>
         <textarea class="form-control" id="description" name="description" required data-error="Vous devez ajouter une description"><?= $description ?></textarea>
         <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
         <div class="help-block with-errors"></div>
       </div>
     </div>
     <?php $p2 = array("paris"=>array("75001", "75002", "75003", "75004", "75005", "75006", "75007", "75008", "75009", "75010", "75011", "75012", "75013", "75014", "75015", "75016", "75017", "75018", "75019", "75020"), "lyon"=>array("69001", "69002", "69003", "69004", "69005", "69006", "69007", "69008", "69009"), "marseille"=>array("13001", "13002", "13003", "13004", "13005", "13006", "13007", "13008", "13009", "13010", "13011", "13012", "13013", "13014", "13015")); ?>
     <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
       <label>Ville</label>
       <select name="ville" id="ville" class="form-control" onchange="changeSelect(this);">
        <option value="">Choisir</option>
        <option value="paris">Paris</option>
        <option value="lyon">Lyon</option>
        <option value="marseille">Marseille</option>
      </select>
    </div>
    <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
     <label>Code postal</label>
     <select name="codepostal" id="codepostal" class="form-control">
      <option value="">Mon choix...</option>
    </select>
  </div>
  <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
   <div class="form-group has-feedback">
     <label>Adresse</label>
     <input type="text" class="form-control" name="adresse" placeholder="Adresse" id="adresse" value="<?= $adresse ?>" required data-error="Vous devez ajouter une adresse">
     <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
     <div class="help-block with-errors"></div>
   </div>
 </div>
 <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
  <div class="form-group has-feedback">
   <label>Capacité</label>
   <input type="text" class="form-control" name="capacite" placeholder="Capacité" id="capacite" value="<?= $capacite ?>" required data-error="Vous devez ajouter une Capacité">
   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
   <div class="help-block with-errors"></div>
 </div>
</div>
<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
 <label>Catégorie</label>
 <select name="categorie" id="categorie" class="form-control">
  <option value="1">Réunion</option>
  <option value="2">Bureau</option>
  <option value="3">Formation</option>
</select>
</div>
<div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
 <div class="form-group has-feedback">
  <label>Votre photo</label>
  <div class="fileUpload btn btn-success">
    <input name="photo" class="uploads" id="photo" type="file" id="fichier_a_uploader" accept="image/*" class="uploads" required data-error="Vous devez choisir une image"/>
  </div>

  <script>
    //Système pour changer le select codepostal en fonction de la ville
    function changeSelect(selected){
      //on recupere le php
      var data = <?php echo json_encode($p2); ?>;
      console.log("selected.value : "+selected.value+", data[selected.value] : "+data[selected.value]);
      var codepostal = document.getElementById("codepostal");
      //on efface tous les children options
      while (codepostal.firstChild) {
        codepostal.removeChild(codepostal.firstChild);
      }
      //on rajoute les nouveaux children options
      for (var chaqueSousTitre of data[selected.value]){
       var opt = document.createElement("option");
       opt.value= chaqueSousTitre;
       opt.innerHTML = chaqueSousTitre;
       codepostal.appendChild(opt);
     }
   }
 </script>

 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
 <div class="help-block with-errors"></div>
</div>
</div>
<input type="submit" id="submitsalle" value="J'ajoute la salle" class="btn btn-default">
</form>
</div>

<?php
$resultat=$pdo->query("SELECT * FROM salle");
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

                <a href="#" data-toggle="modal" data-target="#modalModif<?= $valeur['id_salle'] ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                <div class="modal fade" id="modalModif<?= $valeur['id_salle'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modification de la salle n° <?= $valeur['id_salle'] ?></h4>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="<?= $racinea ?>salles_modifier.php?id=<?= $valeur['id_salle'] ?>" data-toggle="validator" novalidate="true" enctype="multipart/form-data">
                          <div class="col-lg-12 col-md-12 col-ls-12 col-xs-12">
                            <div class="form-group has-feedback">
                             <label>Titre</label>
                             <input type="text" class="form-control" name="titre" placeholder="Titre" id="titre" value="<?= $valeur['titre'] ?>" required data-error="Vous devez ajouter un titre">
                             <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                             <div class="help-block with-errors"></div>
                           </div>
                           <div class="form-group has-feedback">
                             <label>Description</label>
                             <textarea class="form-control" id="description" name="description" required data-error="Vous devez ajouter une description"><?= $valeur['description'] ?></textarea>
                             <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                             <div class="help-block with-errors"></div>
                           </div>
                         </div>
                         <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                           <label>Ville</label>
                           <select name="ville" id="ville" class="form-control" onchange="changeSelect(this);">
                            <option <?php if($valeur['categorie']=='paris'){echo "selected";} ?> value="paris">Paris</option>
                            <option <?php if($valeur['categorie']=='lyon'){echo "selected";} ?> value="lyon">Lyon</option>
                            <option <?php if($valeur['categorie']=='marseille'){echo "selected";} ?> value="marseille">Marseille</option>
                          </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                         <div class="form-group has-feedback">
                           <label>Code postal</label>
                           <input type="text" class="form-control" name="codepostal" placeholder="Code postal" id="codepostal" value="<?= $valeur['cp'] ?>" required data-error="Vous devez ajouter une Code postal">
                           <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                           <div class="help-block with-errors"></div>
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                         <div class="form-group has-feedback">
                           <label>Adresse</label>
                           <input type="text" class="form-control" name="adresse" placeholder="Adresse" id="adresse" value="<?= $valeur['adresse'] ?>" required data-error="Vous devez ajouter une adresse">
                           <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                           <div class="help-block with-errors"></div>
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                        <div class="form-group has-feedback">
                         <label>Capacité</label>
                         <input type="text" class="form-control" name="capacite" placeholder="Capacité" id="capacite" value="<?= $valeur['capacite'] ?>" required data-error="Vous devez ajouter une Capacité">
                         <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                         <div class="help-block with-errors"></div>
                       </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                       <label>Catégorie</label>
                       <select name="categorie" id="categorie" class="form-control">
                        <option <?php if($valeur['categorie']==1){echo "selected";} ?> value="1">Réunion</option>
                        <option <?php if($valeur['categorie']==2){echo "selected";} ?> value="2">Bureau</option>
                        <option <?php if($valeur['categorie']==3){echo "selected";} ?> value="3">Formation</option>
                      </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
                      <label>Votre photo <span></span></label>
                      <div class="btn btn-success">
                        <input type="hidden" name="photo_actuelle" value="<?= $valeur['photo'] ?>">
                        <input name="photo" class="uploads" id="photo" type="file" id="photo" accept="image/*" class="uploads"/>
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
          <a href="#" data-toggle="modal" data-target="#modalSupprimer<?= $valeur['id_salle'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
          <div class="modal fade" id="modalSupprimer<?= $valeur['id_salle'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Supprimer la salle n° <?= $valeur['id_salle'] ?></h4>
                </div>
                <div class="modal-body">
                  <a type="button" class="btn btn-danger" href="<?= $racinea ?>salles_supprimer.php?id=<?= $valeur['id_salle'] ?>">Je valide la suppression de la salle n°<?= $valeur['id_salle'] ?></a>
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