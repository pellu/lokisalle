<?php
session_start();
include('../../config.php');


$civilite=$_POST['nouveaucivilite'];
$id=$_SESSION['userid'];
$modif = $pdo->prepare("UPDATE membre SET civilite=:civilite WHERE id_membre='".$id."'");
$modif->bindValue(':civilite', $civilite);
$modif->execute();

if($modif-> execute()){
    ?>
    <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Succès!</strong> Le changement de civilité est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
    </div>
    <?php
}
?>