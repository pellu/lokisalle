<?php
$pagename="Salles";
include('menu.php');
?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Salles<small>tableau:
          id_salle/titre/description/photo/pays/ville/adresse/cp/capacite/categorie/actions(edit/delete)
          Edit:
          Champs identiques tableau</small>
        </h1>
      </div>
    </div>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Ajout">Ajouter une salle</button>

    <div class="modal fade" id="Ajout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Ajouter une salle</h4>
          </div>
          <div class="modal-body">
            <div id="resultat"></div>
            <form method="POST" id="ajout" data-toggle="validator">
              <div class="form-group has-feedback">
               <label>Titre</label>
               <input type="text" class="form-control" name="titre" placeholder="Titre" id="titre" value="" required data-error="Vous devez ajouter un titre">
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>
             <div class="form-group has-feedback">
               <label>Description</label>
               <textarea class="form-control" id="description" name="description" required data-error="Vous devez ajouter une description"></textarea>
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>

             <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
               <div class="form-group">
                <label>Votre photo</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>"/>
                <div class="fileUpload btn btn-success">
                  <input name="pictures" class="uploads" type="file" id="fichier_a_uploader" accept="image/*" class="uploads" required data-error="Vous devez choisir une image"/>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
             <div class="form-group has-feedback">
               <label>Ville</label>
               <input type="text" class="form-control" name="ville" placeholder="Ville" id="ville" value="" required data-error="Vous devez ajouter une ville">
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>
           </div>
           <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
             <div class="form-group has-feedback">
               <label>Code postal</label>
               <input type="text" class="form-control" name="codepostal" placeholder="Code postal" id="codepostal" value="" required data-error="Vous devez ajouter une Code postal">
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>
           </div>
           <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
             <div class="form-group has-feedback">
               <label>Adresse</label>
               <input type="text" class="form-control" name="adresse" placeholder="Adresse" id="adresse" value="" required data-error="Vous devez ajouter une adresse">
               <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
               <div class="help-block with-errors"></div>
             </div>
           </div>
           <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
            <div class="form-group has-feedback">
             <label>Capacité</label>
             <input type="text" class="form-control" name="capactite" placeholder="Capacité" id="capactite" value="" required data-error="Vous devez ajouter une Capacité">
             <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
             <div class="help-block with-errors"></div>
           </div>
         </div>
         <div class="col-lg-6 col-md-6 col-ls-6 col-xs-6">
           <label>Catégorie</label>
           <select name="categorie" class="form-control">
            <option value="1">Réunion</option>
            <option value="2">Bureau</option>
            <option value="3">Formation</option>
          </select>
        </div>
        <input type="hidden" name="robot" value="">
        <br>
        <input type="submit" id="submitsalle" value="J'ajoute la salle" class="btn btn-default">
      </form>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script>
        $(document).ready(function(){
          $("#submitsalle").click(function(e){
            e.preventDefault();
            $.post(
              '<?= $racinea; ?>ajoutsalle.php',
              {
                titre: $("#titre").val(),
                description : $("#description").val(),
                photo : $("#description").val(),
                pays : $("#pays").val(),
                ville : $("#ville").val(),
                adresse : $("#adresse").val(),
                codepostal : $("#codepostal").val(),
                capacite : $("#capacite").val(),
                categorie : $("#categorie").val()
              },
              function(data){
                $("#resultat").html(data);
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

<div class="row">
  <div class="col-lg-6">
    <h2>Bordered Table</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Page</th>
            <th>Visits</th>
            <th>% New Visits</th>
            <th>Revenue</th>
          </tr>
        </thead>
        <tbody>
         <tr>
           <td>/index.html</td>
           <td>1265</td>
           <td>32.3%</td>
           <td>$321.33</td>
         </tr>
         <tr>
           <td>/about.html</td>
           <td>261</td>
           <td>33.3%</td>
           <td>$234.12</td>
         </tr>
         <tr>
           <td>/sales.html</td>
           <td>665</td>
           <td>21.3%</td>
           <td>$16.34</td>
         </tr>
         <tr>
           <td>/blog.html</td>
           <td>9516</td>
           <td>89.3%</td>
           <td>$1644.43</td>
         </tr>
         <tr>
           <td>/404.html</td>
           <td>23</td>
           <td>34.3%</td>
           <td>$23.52</td>
         </tr>
         <tr>
           <td>/services.html</td>
           <td>421</td>
           <td>60.3%</td>
           <td>$724.32</td>
         </tr>
         <tr>
           <td>/blog/post.html</td>
           <td>1233</td>
           <td>93.2%</td>
           <td>$126.34</td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>
 <div class="col-lg-6">
   <h2>Bordered with Striped Rows</h2>
   <div class="table-responsive">
     <table class="table table-bordered table-hover table-striped">
       <thead>
         <tr>
           <th>Page</th>
           <th>Visits</th>
           <th>% New Visits</th>
           <th>Revenue</th>
         </tr>
       </thead>
       <tbody>
        <tr>
          <td>/index.html</td>
          <td>1265</td>
          <td>32.3%</td>
          <td>$321.33</td>
        </tr>
        <tr>
          <td>/about.html</td>
          <td>261</td>
          <td>33.3%</td>
          <td>$234.12</td>
        </tr>
        <tr>
          <td>/sales.html</td>
          <td>665</td>
          <td>21.3%</td>
          <td>$16.34</td>
        </tr>
        <tr>
          <td>/blog.html</td>
          <td>9516</td>
          <td>89.3%</td>
          <td>$1644.43</td>
        </tr>
        <tr>
          <td>/404.html</td>
          <td>23</td>
          <td>34.3%</td>
          <td>$23.52</td>
        </tr>
        <tr>
          <td>/services.html</td>
          <td>421</td>
          <td>60.3%</td>
          <td>$724.32</td>
        </tr>
        <tr>
          <td>/blog/post.html</td>
          <td>1233</td>
          <td>93.2%</td>
          <td>$126.34</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>
<!-- /.row -->

<div class="row">
  <div class="col-lg-6">
    <h2>Basic Table</h2>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Page</th>
            <th>Visits</th>
            <th>% New Visits</th>
            <th>Revenue</th>
          </tr>
        </thead>
        <tbody>
         <tr>
           <td>/index.html</td>
           <td>1265</td>
           <td>32.3%</td>
           <td>$321.33</td>
         </tr>
         <tr>
           <td>/about.html</td>
           <td>261</td>
           <td>33.3%</td>
           <td>$234.12</td>
         </tr>
         <tr>
           <td>/sales.html</td>
           <td>665</td>
           <td>21.3%</td>
           <td>$16.34</td>
         </tr>
         <tr>
           <td>/blog.html</td>
           <td>9516</td>
           <td>89.3%</td>
           <td>$1644.43</td>
         </tr>
         <tr>
           <td>/404.html</td>
           <td>23</td>
           <td>34.3%</td>
           <td>$23.52</td>
         </tr>
         <tr>
           <td>/services.html</td>
           <td>421</td>
           <td>60.3%</td>
           <td>$724.32</td>
         </tr>
         <tr>
           <td>/blog/post.html</td>
           <td>1233</td>
           <td>93.2%</td>
           <td>$126.34</td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>
 <div class="col-lg-6">
   <h2>Striped Rows</h2>
   <div class="table-responsive">
     <table class="table table-hover table-striped">
       <thead>
         <tr>
           <th>Page</th>
           <th>Visits</th>
           <th>% New Visits</th>
           <th>Revenue</th>
         </tr>
       </thead>
       <tbody>
        <tr>
          <td>/index.html</td>
          <td>1265</td>
          <td>32.3%</td>
          <td>$321.33</td>
        </tr>
        <tr>
          <td>/about.html</td>
          <td>261</td>
          <td>33.3%</td>
          <td>$234.12</td>
        </tr>
        <tr>
          <td>/sales.html</td>
          <td>665</td>
          <td>21.3%</td>
          <td>$16.34</td>
        </tr>
        <tr>
          <td>/blog.html</td>
          <td>9516</td>
          <td>89.3%</td>
          <td>$1644.43</td>
        </tr>
        <tr>
          <td>/404.html</td>
          <td>23</td>
          <td>34.3%</td>
          <td>$23.52</td>
        </tr>
        <tr>
          <td>/services.html</td>
          <td>421</td>
          <td>60.3%</td>
          <td>$724.32</td>
        </tr>
        <tr>
          <td>/blog/post.html</td>
          <td>1233</td>
          <td>93.2%</td>
          <td>$126.34</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>
<!-- /.row -->

<div class="row">
  <div class="col-lg-6">
    <h2>Contextual Classes</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>Page</th>
            <th>Visits</th>
            <th>% New Visits</th>
            <th>Revenue</th>
          </tr>
        </thead>
        <tbody>
         <tr class="active">
           <td>/index.html</td>
           <td>1265</td>
           <td>32.3%</td>
           <td>$321.33</td>
         </tr>
         <tr class="success">
           <td>/about.html</td>
           <td>261</td>
           <td>33.3%</td>
           <td>$234.12</td>
         </tr>
         <tr class="warning">
           <td>/sales.html</td>
           <td>665</td>
           <td>21.3%</td>
           <td>$16.34</td>
         </tr>
         <tr class="danger">
           <td>/blog.html</td>
           <td>9516</td>
           <td>89.3%</td>
           <td>$1644.43</td>
         </tr>
         <tr>
           <td>/404.html</td>
           <td>23</td>
           <td>34.3%</td>
           <td>$23.52</td>
         </tr>
         <tr>
           <td>/services.html</td>
           <td>421</td>
           <td>60.3%</td>
           <td>$724.32</td>
         </tr>
         <tr>
           <td>/blog/post.html</td>
           <td>1233</td>
           <td>93.2%</td>
           <td>$126.34</td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>
 <div class="col-lg-6">
   <h2>Bootstrap Docs</h2>
   <p>For complete documentation, please visit <a target="_blank" href="http://getbootstrap.com/css/#tables">Bootstrap's Tables Documentation</a>.</p>
 </div>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>