<?php

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
<form action="" method="get" data-toggle="validator">
    <div class="form-group has-feedback">
         Modif requete php<br>
        <label>Nom d'utilisateur</label>
        <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" id="pseudo" value="<?php $pseudo; ?>" required data-error="Vous devez écrire votre pseudo">
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
    <button type="submit" value="Connexion" class="btn btn-default">Connexion</button>
</form>