<?php
session_start();
include('config.php');

if(isset($_POST['pseudo']) && isset($_POST['password'])){
    $resultat = $pdo -> prepare('SELECT * FROM membre WHERE pseudo=:pseudo');
    $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat -> execute();
    
   

    if($resultat -> rowCount() > 0 ){
        $users = $resultat -> fetch(PDO::FETCH_ASSOC);

        if($users['mdp'] == sha1($_POST['password'])){
            
            $req = $pdo->query('SELECT * FROM membre WHERE pseudo="'.$_POST['pseudo'].'"');
            $resultsql = $req->fetch();
            if($resultsql['statut'] == 2){
                ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Attention!</strong> Vous avez désactivé votre compte !
            </div>
            <?php
            } else {
                $_SESSION['user'] = $_POST['pseudo'];
                $_SESSION['userid'] = $users['id_membre'];
                ?>
                <script type="text/javascript">
                    //window.location = "<?php echo $_SERVER["HTTP_REFERER"]; ?>";
                </script>
                 <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Succès!</strong> La connexion est réussis.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
                </div>
            <?php
            }
            
        }else{
            ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Attention!</strong> Le mot de passe que vous avez mis n'est pas le bon.
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Le pseudo que vous avez mis n'existe pas.
        </div>
        <?php

    }
}else{
    ?>
    <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Attention!</strong> Vous n'avez rien écrit dans les champs
    </div>
    <?php
}
?>