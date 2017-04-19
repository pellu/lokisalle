<?php
session_start();
include('config.php');

$msg="";

if($_POST){
    if(!empty($_POST['pseudo'])){
        $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
        if($verif_caractere == TRUE){
            if(strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 25){
                $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un pseudo de 3 à 25 caractères
        </div>';
            }
            $resultatb = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
            $resultatb -> bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
            $resultatb -> execute();
            if($resultatb -> rowCount() > 0){
                $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Le pseudo <b>'.$_POST['pseudo'].'</b> est déjà utilisé par un autre utilisateur !
        </div>';
            }else{
            }
        }else{
            $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Caractères acceptés pour le pseudo : de A à Z, de 0 à 9, -, _, et .
        </div>';
        }
    }else{
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un pseudo !
        </div>';
    }
    if(strlen($_POST['password']) < 6){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un mot de passe d\'au moins 6 caractères.
        </div>';
    }else{
    }
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $resultatemail = $pdo -> prepare("SELECT * FROM membre WHERE email = :email");
        $resultatemail -> bindValue(':email',$_POST['email'], PDO::PARAM_STR);
        $resultatemail -> execute();
        if($resultatemail -> rowCount() > 0){
            $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Le mail <b>'.$_POST['email'].'</b> est déjà utilisé par un autre utilisateur !
        </div>';
        }else{

        }
    }else{
        $msg .= '
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Cet email a un format non adapté.
        </div>';
    }
    
    if(empty($_POST['prenom'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez choisir votre prenom.
        </div>';
    }

    if(empty($_POST['nom'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez choisir votre nom.
        </div>';
    }

    if(empty($_POST['civilite'])){
        $msg .= '
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez choisir votre sexe.
        </div>';
    }

    if(empty($msg)){
        $date_enregistrement=time();
        $resultat = $pdo -> prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, :date_enregistrement)");

        $resultat -> bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat -> bindValue(':date_enregistrement', $date_enregistrement, PDO::PARAM_INT);
        $mdp_crypte = sha1($_POST['password']);
        $resultat -> bindValue(':mdp', $mdp_crypte, PDO::PARAM_STR);
        $resultat -> bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $resultat -> bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $statut=0;
        $resultat -> bindValue(':statut', $statut, PDO::PARAM_INT);
        $resultat -> bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $resultat -> bindValue(':email', $_POST['email'], PDO::PARAM_STR);

        $count = $pdo->query('SELECT id_membre FROM membre');
        $countuserid = $count->rowCount();

        if($resultat -> execute()){
            echo "ok";
            $_SESSION['user'] = $_POST['pseudo'];
            $_SESSION['userid'] = $countuserid;
            ?>
            <script type="text/javascript">
                window.location = "<?php echo $_SERVER["HTTP_REFERER"]; ?>";
            </script>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Succès!</strong> L'inscription est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
            </div>
            <?php
        }
    }
}
echo $msg;
?>