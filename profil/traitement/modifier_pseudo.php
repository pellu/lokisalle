<?php
session_start();
include('../../config.php');

$msg="";

if($_POST){
    if(empty($_POST['nouveaupseudo'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nouveau pseudo !
        </div>';
    }else{
        $nouveaupseudo=$_POST['nouveaupseudo'];

        $stmtc = $pdo->query("SELECT COUNT(pseudo) FROM membre WHERE pseudo='".$nouveaupseudo."'");
        $compteurc = $stmtc->fetchColumn();

        if($_POST['nouveaupseudo'] != $_SESSION['user']){
            if($compteurc > 0){                                          
                $msg .="Le pseudo <b>".$_POST['nouveaupseudo']."</b> est déjà pris par un autre utilisateur";
            }
        }else{
            $msg .="C'est votre profil";
        }
    }

    if(empty($msg)){
        $pseudo=$_POST['nouveaupseudo'];
        $id=$_SESSION['userid'];
        $modif = $pdo->prepare("UPDATE membre SET pseudo=:pseudo WHERE id_membre='".$id."'");
        $modif->bindValue(':pseudo', $pseudo);
        $modif->execute();
        $_SESSION['user'] = $pseudo;

        if($modif-> execute()){
            ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Succès!</strong> Le changement de pseudo est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
            </div>
            <?php
        }
    }
}
echo $msg;
?>