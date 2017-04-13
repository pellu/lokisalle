<?php
session_start();
include('../config.php');

$msg="";
          //id_salle/titre/description/photo/pays/ville/adresse/cp/capacite/categorie/actions(edit/delete)

if($_POST){
    if(empty($_POST['titre'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez renseigner un nom de salle !
        </div>';
    }
    if(empty($_POST['description'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez ajouter une description.
        </div>';
    }

    if(empty($_POST['photo'])){
        $msg .= '<div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Attention!</strong> Veuillez ajouter une photo.
        </div>';
    }

    if(empty($msg)){
        $date_enregistrement=time();
        $resultat = $pdo -> prepare("INSERT INTO salle (titre, description, photo, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :ville, :adresse, :cp, :capacite, :categorie)");

        $resultat -> bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $resultat -> bindValue(':description', $_POST['description'], PDO::PARAM_STR);
        $resultat -> bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
        $resultat -> bindValue(':photo', $_POST['photo'], PDO::PARAM_STR);
        $resultat -> bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $resultat -> bindValue(':cp', $_POST['codepostal'], PDO::PARAM_INT);
        $resultat -> bindValue(':capacite', $_POST['capacite'], PDO::PARAM_INT);
        $resultat -> bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);

        if($resultat -> execute()){
            ?>
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