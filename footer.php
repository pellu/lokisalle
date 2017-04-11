    <div class="container">
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Lokisalle 2017 - <a href="<?= $racines; ?>mentionslegales/">Mentions Légales</a> - <a href="<?= $racines; ?>cgv/">Conditions générales de ventes</a> - <a href="<?= $racines; ?>cgu/">Conditions générales d'utilisation</a></p>
                </div>
            </div>
        </footer>
    </div>
    <!--Modal de connexion-->
    <div class="modal fade" id="insciptionConnexion" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="card"><h4 class="modal-title">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#connexion" aria-controls="connexion" role="tab" data-toggle="tab">Connexion</a></li>
                            <li role="presentation"><a href="#inscription" aria-controls="inscription" role="tab" data-toggle="tab">Inscription</a></li>
                        </ul></h4>
                    </div>

                </div>



                <div class="modal-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="connexion"><p>


<div id="resultat">
</div>

                      <form data-toggle="validator">
                        <div class="form-group has-feedback">
                         Modif requete php<br>
                         <div id="resultat"></div>
                         <label>Nom d'utilisateur</label>
                         <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" id="username" value="<?php $pseudo; ?>" required data-error="Vous devez écrire votre pseudo">
                         <span class="glyphicon form-control-feedback" aria-hidden="true" style="top: 45px;"></span>
                         <div class="help-block with-errors"></div>
                     </div>
                     <div class="form-group has-feedback">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control" value="" placeholder="Mot de passe" name="password" required data-error="Vous avez oublié votre mot de passe">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="hidden" name="robot" value="">
                    <input type="submit" id="submit" value="Connexion" class="btn btn-default">
                </form>
                                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

                <script>
                    $(document).ready(function(){
                      $("#submit").click(function(e){
                          e.preventDefault();
                          $.post(
                              'http://localhost/lokisalle/connexion.php',
                              {
                                username: $("#username").val(),
                                password : $("#password").val()
                            },
                            function(data){
                              if(data == 'Success'){
                                $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
                            }
                            else{
                                $("#resultat").html("<p>Erreur lors de la connexion...</p>");
                            }
                        },
                        'text'
                        );
                      });
                  });
              </script>
          </div>
          <div role="tabpanel" class="tab-pane" id="inscription"><p><?php include('inscription.php'); ?></p></div>
      </div>
  </div>
</div>
</div>
</div>
<!--Modal d'inscription-->
<div class="modal fade" id="inScription" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<script src="<?= $racines; ?>js/jquery.js"></script>
<script src="<?= $racines; ?>js/bootstrap.min.js"></script>
<script src="<?= $racines; ?>js/validator.js"></script>
</body>
</html>