<?php
session_start();
include('../../config.php');

$msg="";

if($_POST){
    if(empty($_POST['nouveaumail'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nouveau mail !
        </div>';
    }else{
        $nouveaumail=$_POST['nouveaumail'];
        $stmtc = $pdo->query("SELECT COUNT(email) FROM membre WHERE email='".$nouveaumail."'");
        $compteurc = $stmtc->fetchColumn();
        
        if($_POST['nouveaumail'] != $resultsql['email']){
            if($compteurc > 0){                                          
                $msg .="Le mail <b>".$_POST['nouveaumail']."</b> est déjà pris par un autre utilisateur";
            }
        }else{
            $msg .="C'est déja votre mail";
        }
    }

    if(filter_var($_POST['nouveaumail'], FILTER_VALIDATE_EMAIL)) {
        if(empty($msg)){
            $mail=$_POST['nouveaumail'];
            $id=$_SESSION['userid'];
            $modif = $pdo->prepare("UPDATE membre SET email=:mail WHERE id_membre='".$id."'");
            $modif->bindValue(':mail', $mail);
            $modif->execute();

            if($modif-> execute()){
                ?>
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Succès!</strong> Le changement de mail est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
                </div>
                <?php
            }
        }
    }else{
        $msg .="<strong>Attention!</strong> Cet email a un format non adapté.";
    }
}
echo $msg;
?>