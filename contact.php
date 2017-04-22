<?php
session_start();
$pagename="contact";
include('menu.php'); ?>

<?php
if(isset($_SESSION['user'])){
    if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos=$resultsql['pseudo'];
    if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email=$resultsql['email'];
}else{
 if(isset($_POST['infos'])) $infos=htmlspecialchars(addslashes($_POST['infos'])); else $infos="";
 if(isset($_POST['email'])) $email=htmlspecialchars(addslashes($_POST['email'])); else $email="";
}
if(isset($_POST['objet'])) $objet=htmlspecialchars(addslashes($_POST['objet'])); else $objet="";
if(isset($_POST['contenu'])) $contenu=htmlspecialchars(addslashes($_POST['contenu'])); else $contenu="";

$msg='';

if($_POST){
    if(empty($_POST['infos'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un pseudo !</div>';
    }
    if(empty($_POST['email'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un email !</div>';
    }
    if(empty($_POST['objet'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un objet !</div>';
    }
    if(empty($_POST['contenu'])){
        $msg .= '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Attention!</strong> Veuillez renseigner un message !</div>';
    }
    if(empty($msg)){
        $to      = 'contact@pellu.fr';
        $subject = $_POST['objet'];
        $message = $_POST['contenu'];
        $headers = 'From: "'.$_POST['email'].'"' . "\r\n" .
        'Reply-To: "'.$_POST['email'].'"' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        $msg='<div class="alert alert-success" role="alert">Nous avons bien reçu votre message</div>';
        $objet='';
        $contenu='';
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contactez-nous</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>Pour nous contacter veuillez utiliser le formulaire de contact ci-dessous. Vous pouvez aussi nous envoyer des lettres à l'adresse 300 Boulevard de Vaugirard, 75015 Paris, France en mentionnant LOKISALLE.</p>
                    <?= $msg; ?>
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
                            <textarea name="contenu" class="form-control" rows="3" placeholder="Description" required data-error="Vous devez écrire un message"><?php echo $contenu; ?></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <button type="submit" value="submit" class="btn btn-default">J'envoi le formulaire</button>
                    </form>
                </div><br>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.04982597066!2d2.295621251593011!3d48.838188279183846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670155e708f7b%3A0xc1375b95f3fddee5!2s300+Rue+de+Vaugirard%2C+75015+Paris!5e0!3m2!1sen!2sfr!4v1492434024878" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>