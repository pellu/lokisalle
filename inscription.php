formulaire inscription pop-in dans le menu
pseudo/mdp/nom/prenom/email/sexe
- changer les nom des champs
<?php
ob_start();
session_start();

$msg="";
$pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';

if($_POST){
    if(!empty($_POST['pseudo'])){
        $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
        if($verif_caractere == TRUE){
            if(strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 25){
                $msg .= '<div class="erreur">Veuillez renseigner un pseudo de 3 à 25 caractères</div>';
            }
            $resultatb = $pdo -> prepare("SELECT * FROM users WHERE pseudo = :pseudo");
            $resultatb -> bindParam(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
            $resultatb -> execute();
            if($resultatb -> rowCount() > 0){
                $msg .= '<div class"erreur">Le mail <b>'.$_POST['pseudo'].'</b> est déjà utilisé par un autre utilisateur !</div>';
            }else{
            }
        }else{
            $msg .= '<div class="erreur">Caractères acceptés : de A à Z, de 0 à 9, -, _, et .</div>';
        }
    }else{
        $msg .= '<div class="erreur">Veuillez renseigner un pseudo !</div>';
    }
    if(strlen($_POST['password']) < 5){
        $msg .= '<div class="erreur">Veuillez renseigner un mot de passe d\'au moins 6 caractères</div>';
    }else{
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $resultatemail = $pdo -> prepare("SELECT * FROM users WHERE email = :email");
        $resultatemail -> bindParam(':email',$_POST['email'], PDO::PARAM_STR);
        $resultatemail -> execute();
        if($resultatemail -> rowCount() > 0){
            $msg .= '<div class"erreur">Le mail <b>'.$_POST['email'].'</b> est déjà utilisé par un autre utilisateur !</div>';
        }else{

        }
    }else{
        $msg .= 'Cet email a un format non adapté.';
    }
    
    if(empty($msg)){
        $signup_date=time();

        $resultat = $pdo -> prepare("INSERT INTO users (signup_date, pseudo, password, email) VALUES (:signup_date, :pseudo, :password, :email)");

        $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat -> bindParam('signup_date', $signup_date, PDO::PARAM_INT);
        $mdp_crypte = sha1($_POST['password']);
        $resultat -> bindParam(':password', $mdp_crypte, PDO::PARAM_STR);
        $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);

        $count = $pdo->query('SELECT id FROM users');
        $countuserid = $count->rowCount();

        if($resultat -> execute()){
            $_SESSION['membre'] = $_POST['pseudo'];
            $_SESSION['userid'] = $countuserid;
            header('Location:'.$racinea.'');
        }
    }
}
?>

<div class="container">
    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Formulaire d'inscription
            </h1>
            <h2>
                <?php echo $msg; ?>
            </h2>
        </div>
        <!-- Formulaire de recherche -->
        <div class="col-md-3 col-md-offset-4 col-centered">
            <form action="" method="post" data-toggle="validator">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" id="pseudo" value="<?= $pseudo; ?>" required data-error="Vous devez choisir un pseudo">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="small">(6 caract&egrave;res min.)</span></label>
                    <input type="password" class="form-control" value="" placeholder="Mot de passe" name="password" required data-error="Vous devez écrire un mot de passe">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= $email; ?>"" placeholder="Email" name="email"  required data-error="Vous avez oublié d'indiquer votre mail">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <input type="hidden" name="robot" value="">
                <button type="submit" value="Envoyer" class="btn btn-default">Je m'inscris</button>
            </form>
        </div>
    </div>
    <hr>
</div>
