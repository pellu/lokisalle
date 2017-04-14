<?php
session_start();
include('../config.php');

    if ( 0 < $_FILES['photo']['error'] ) {
        echo 'Error: ' . $_FILES['photo']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $_FILES['photo']['name']);
    }


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

    //Génération de l'url aléatoire pour l'image
function random($str) {
    $string = "";
    $url = "abcdefghijklmnpqrstuvwxy0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    srand((double)microtime()*1000000);
    for($i=0; $i<$str; $i++) {
        $string .= $url[rand()%strlen($url)];
    }
    return $string;
}
$url = random(10);

$nom_photo='default.jpg';

if(empty($_FILES['photo'])){
    $msg .= '<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Attention!</strong> Veuillez ajouter une photo.
</div>';
}else{
    $nom_photo=$url.'_'.$_SESSION['user'].'.'.pathinfo($_POST['photo'], PATHINFO_EXTENSION);
    $chemin_photo= $racines.'images/'.$nom_photo;
    echo $chemin_photo;
    copy($_FILES['photo'], $chemin_photo);
}

    $data['file'] = $_FILES;
    $data['text'] = $_POST;
 
    echo json_encode($data);


if(empty($msg)){
    $date_enregistrement=time();
    $resultat = $pdo -> prepare("INSERT INTO salle (titre, description, photo, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :ville, :adresse, :cp, :capacite, :categorie)");

    $resultat -> bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
    $resultat -> bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    $resultat -> bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
    $resultat -> bindValue(':photo', $nom_photo, PDO::PARAM_STR);
    $resultat -> bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
    $resultat -> bindValue(':cp', $_POST['codepostal'], PDO::PARAM_INT);
    $resultat -> bindValue(':capacite', $_POST['capacite'], PDO::PARAM_INT);
    $resultat -> bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);

    if($resultat -> execute()){
        ?>
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Succès!</strong> L'ajout de la salle est ok.<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Rafraichir la page</a>
        </div>
        <?php
    }
}
}
echo $msg;
?>