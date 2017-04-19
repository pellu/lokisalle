<?php
session_start();
$pagename="contact";
include('menu.php'); ?>

<?php
//Gestion de l'envoi du formulaire par jordan (mercredi)
if(isset($_SESSION['user'])){
    if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos=$resultsql['pseudo'];
    if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email=$resultsql['email'];
}else{
   if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos="";
   if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email="";
}
if(isset($_POST['objet'])) $objet=htmlspecialchars(addslashes($_POST['objet'])); else $objet="";
if(isset($_POST['contenu'])) $contenu=htmlspecialchars(addslashes($_POST['contenu'])); else $contenu="";
?>

<div class="container">
    <div class="row">
        <!--Page avec formulaire de contact, envoi email à l'admin / s'il y a le temps ajout dans le back office de l'historique des mails et réponse dans l'admin Raison sociale : LOKISALLE Adresse : 300 Boulevard de Vaugirard, 75015 Paris, France-->


        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.04982597066!2d2.295621251593011!3d48.838188279183846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670155e708f7b%3A0xc1375b95f3fddee5!2s300+Rue+de+Vaugirard%2C+75015+Paris!5e0!3m2!1sen!2sfr!4v1492434024878" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="col-md-6">
            <h1 class="page-header">Contactez-nous</h1>
            <form role="form" action="" name="contact" method="post" data-toggle="validator">
                <div class="form-group has-feedback" <?php if(isset($_SESSION[ 'user'])){echo 'style="display:none;visibility:hidden;"';}else{} ?>>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" name="infos" placeholder="Pseudo" value="<?php echo $infos; ?>" maxlength="200" required data-error="Vous devez écrire votre pseudo">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback" <?php if(isset($_SESSION[ 'user'])){echo 'style="display:none;visibility:hidden;"';}else{} ?>>
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php echo $email; ?>" maxlength="200" required data-error="Vous devez écrire un email valide">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="objet">Objet</label>
                    <input type="text" class="form-control" name="objet" placeholder="Objet" value="<?php echo $objet; ?>" maxlength="200" required data-error="Vous devez écrire un objet">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="contenu" class="form-control" rows="3" placeholder="Description" required data-error="Vous devez écrire un message"></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <button type="submit" value="submit" class="btn btn-default">J'envoi le formulaire</button>
            </form>
        </div>
    </div>
</div>
    <?php
    include('footer.php');
    ?>
