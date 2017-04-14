<?php
session_start();
include('../../config.php');

$msg="";

if($_POST){
    if(empty($_POST['nouveaunom'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nouveau nom !
        </div>';
    }
    
    if($_POST['nouveaunom'] == $resultsql['nom']){
            $msg .="C'ets déja votre nom";
    }

    if(empty($msg)){
        $nom=$_POST['nouveaunom'];
        $id=$_SESSION['userid'];
        $modif = $pdo->prepare("UPDATE membre SET nom=:nom WHERE id_membre='".$id."'");
        $modif->bindValue(':nom', $nom);
        $modif->execute();

        if($modif-> execute()){
            ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Succès!</strong> Le changement de nom est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
            </div>
            <?php
        }
    }
}
echo $msg;
?>