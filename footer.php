    <div class="container">
      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Lokisalle 2017 - <a href="<?= $racines; ?>mentionslegales/">Mentions Légales</a> - <a href="<?= $racines; ?>cgv/">Conditions générales de ventes</a></p>
          </div>
        </div>
      </footer>
    </div>
    <div class="modal fade" id="insciptionConnexion" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <ul id="presentation" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#connexion" aria-controls="connexion" role="tab" data-toggle="tab">Connexion</a></li>
            <li role="presentation"><a href="#inscription" aria-controls="inscription" role="tab" data-toggle="tab">Inscription</a></li>
          </ul>
          <div class="modal-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="connexion">
                <div id="resultat"></div>
                <form method="post" data-toggle="validator">
                  <div class="form-group has-feedback">
                   <label>Nom d'utilisateur</label>
                   <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" id="pseudo" value="" required data-error="Vous devez écrire votre pseudo">
                   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                   <div class="help-block with-errors"></div>
                 </div>
                 <div class="form-group has-feedback">
                  <label>Mot de passe</label>
                  <input type="password" class="form-control" value="" placeholder="Mot de passe" id="password" name="password" required data-error="Vous avez oublié votre mot de passe">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="robot" value="">
                <input type="submit" id="submitconnexion" value="Connexion" class="btn btn-default">
              </form>
              <script>
                $(document).ready(function(){
                  $("#submitconnexion").click(function(e){
                    e.preventDefault();
                    $.post(
                      '<?= $racines; ?>connexion.php',
                      {
                        pseudo: $("#pseudo").val(),
                        password : $("#password").val()
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
            <div role="tabpanel" class="tab-pane" id="inscription">
              <div id="resultatinscription"></div>
              <form method="POST" id="inscription" data-toggle="validator">
                <div class="form-group has-feedback">
                  <label>Nom d'utilisateur</label>
                  <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" id="pseudo2" value="" required data-error="Vous devez choisir un pseudo">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                  <label>Prénom</label>
                  <input type="text" class="form-control" value="" placeholder="Prénom" id="prenom2" name="prenom" required data-error="Vous devez écrire un Prénom">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                  <label>Nom</label>
                  <input type="text" class="form-control" value="" placeholder="Nom" id="nom2" name="nom" required data-error="Vous devez écrire un Nom">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group ">
                  <label for="civilite">Sexe</label><br>
                  <label>
                    <input type="radio" name="civilite" id="civilite2" value="h" checked> Homme
                  </label>
                  <label>
                    <input type="radio" name="civilite" id="civilite2" value="f"> Femme
                  </label>
                  <label>
                    <input type="radio" name="civilite" id="civilite2" value="a"> Autre
                  </label>
                </div>
                <div class="form-group has-feedback">
                  <label>Email</label>
                  <input type="email" class="form-control" value="" id="email2" placeholder="Email" name="email"  required data-error="Vous avez oublié d'indiquer votre mail">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                  <label>Mot de passe <span class="small">(6 caract&egrave;res min.)</span></label>
                  <input type="password" class="form-control" id="password2" value="" placeholder="Mot de passe" name="password" required data-error="Vous devez écrire un mot de passe">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="robot" value="">
                <input type="submit" id="submitinscription" value="Je m'inscris" class="btn btn-default">
              </form>
              <script>
                $(document).ready(function(){
                  $("#submitinscription").click(function(e){
                    e.preventDefault();
                    $.post(
                      '<?= $racines; ?>inscription.php',
                      {
                        pseudo: $("#pseudo2").val(),
                        nom: $("#nom2").val(),
                        prenom: $("#prenom2").val(),
                        statut: $("#statut2").val(),
                        civilite: $("#civilite2").val(),
                        email: $("#email2").val(),
                        password : $("#password2").val()
                      },
                      function(data){
                        $("#resultatinscription").html(data);
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
    </div>
  </div>
  <?php if($pageprofil == 'profil'){
    ?>
    <script src="<?= $racines; ?>js/jquery.js"></script>
    <?php
  }else{
  }
  ?>
  <script src="<?= $racinea; ?>js/bootstrap.min.js"></script>
  <script src="<?= $racines; ?>js/validator.js"></script>
</body>
</html>