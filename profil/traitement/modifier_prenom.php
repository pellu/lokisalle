<?php
session_start();
include('../../config.php');

$msg="";

if($_POST){
    if(empty($_POST['nouveauprenom'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nouveau prénom !
        </div>';
    }
    
    if($_POST['nouveauprenom'] == $resultsql['prenom']){
            $msg .="C'ets déja votre prénom";
    }

    if(empty($msg)){
        $prenom=$_POST['nouveauprenom'];
        $id=$_SESSION['userid'];
        $modif = $pdo->prepare("UPDATE membre SET prenom=:prenom WHERE id_membre='".$id."'");
        $modif->bindValue(':prenom', $prenom);
        $modif->execute();

        if($modif-> execute()){
            ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Succès!</strong> Le changement de prénom est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
            </div>
            <?php
        }
    }
}
echo $msg;
?>