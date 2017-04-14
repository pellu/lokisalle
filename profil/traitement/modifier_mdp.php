<?php
session_start();
include('../../config.php');

$msg="";

if($_POST){
    if(empty($_POST['nouveaumdp'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nouveau mot de passe ! !
        </div>';
    }else{
        $nouveaumdp=sha1($_POST['nouveaumdp']);
        if($nouveaumdp == $resultsql['mdp']){
            $msg .="C'est votre mot de passe actuel";
        }
    }

    if(empty($msg)){
        $mdp=sha1($_POST['nouveaumdp']);
        $id=$_SESSION['userid'];
        $modif = $pdo->prepare("UPDATE membre SET mdp=:mdp WHERE id_membre='".$id."'");
        $modif->bindValue(':mdp', $mdp);
        $modif->execute();

        if($modif-> execute()){
            ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Succès!</strong> Le changement de mot de passe est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
            </div>
            <?php
        }
    }
}
echo $msg;
?>