<?php
include('config.php');



if(isset($_POST['pseudo']) && isset($_POST['password'])){
    $resultat = $pdo -> prepare('SELECT * FROM membre WHERE pseudo=:pseudo');
    $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat -> execute();

    if($resultat -> rowCount() > 0 ){
        $users = $resultat -> fetch(PDO::FETCH_ASSOC);

        if($users['mdp'] == sha1($_POST['password'])){
            $_SESSION['membre'] = $_POST['pseudo'];
            $_SESSION['userid'] = $users['id_membre'];
            // header('Location: '.$racinea.'');
            echo "Success";
        }else{
            echo "Password";
        }
    }else{
        ?>
<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> There was a problem with your network connection.
</div>
        <?php
        echo "Pseudo";
    }
}else{
    echo "error";
}
?>
 