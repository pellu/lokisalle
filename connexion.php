<?php

    /**
     * Nous créons deux variables : $username et $password qui valent respectivement "Sdz" et "salut"
     */

    $username = "Sdz";
    $password = "salut";

    if( isset($_POST['username']) && isset($_POST['password']) ){

        if($_POST['username'] == $username && $_POST['password'] == $password){ // Si les infos correspondent...
            session_start();
            $_SESSION['user'] = $username;
            echo "Success";        
        }
        else{ // Sinon
            echo "Failed";
        }

    }

/*

$msg='';
$pseudo='';
if($_POST){
    $resultat = $pdo -> prepare('SELECT password,id FROM users WHERE pseudo=:pseudo');
    $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat -> execute();

    if($resultat -> rowCount() > 0 ){
        $users = $resultat -> fetch(PDO::FETCH_ASSOC);
        if($users['password'] == sha1($_POST['password'])){
            $_SESSION['membre'] = $_POST['pseudo'];
            $_SESSION['userid'] = $users['id'];
            header('Location: '.$racinea.'');
        }else{
            $msg .= '<div class="erreur">Erreur de mot de passe !</div>';
        }
    }else{
        $msg .= '<div class="erreur">Erreur de pseudo !</div>';
    }
}*/
?>