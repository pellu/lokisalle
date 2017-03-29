Pop-in dans le menu - changer les nom des champs
<?php
ob_start();
session_start();
include('header.php');

$msg='';
$pseudo='';
if($_POST){
    $resultat = $pdo -> prepare('SELECT password,id FROM users WHERE pseudo=:pseudo');
    $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat -> execute();

    if($resultat -> rowCount() > 0 ){
        $users = $resultat -> fetch(PDO::FETCH_ASSOC);
        if($users['password'] == sha1($_POST['password'])){
            $_SESSION['membre'] = $_POST['pseudo'];
            $_SESSION['userid'] = $users['id'];
            header('Location: '.$racinea.'');
        }else{
            $msg .= '<div class="erreur">Erreur de mot de passe !</div>';
        }
    }else{
        $msg .= '<div class="erreur">Erreur de pseudo !</div>';
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Connexion
            </h1>
            <h2>
                <?= $msg ?>
            </h2>
        </div>
        <div class="col-md-3 col-md-offset-4 col-centered">
            <form action="" method="post" data-toggle="validator">
                <div class="form-group has-feedback">
                    <label>Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" id="pseudo" value="<?php $pseudo; ?>" required data-error="Vous devez écrire votre pseudo">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" value="" placeholder="Mot de passe" name="password" required data-error="Vous avez oublié votre mot de passe">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="robot" value="">
                <button type="submit" value="Connexion" class="btn btn-default">Connexion</button>
            </form>
        </div>
    </div>
    <hr>
</div>
