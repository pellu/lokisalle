<?php
session_start();
$pagename="Lokisalle";
include('menu.php');

$nombre_de_msg_par_page=9; 

$reponse=$pdo->query('SELECT COUNT(*) AS contenu FROM produit INNER JOIN salle ON salle.id_salle=produit.id_salle WHERE produit.etat="libre" AND produit.date_arrivee>="'.date('d-m-Y').'" ORDER BY produit.date_arrivee');
$total_messages = $reponse->fetch();
$nombre_messages=$total_messages['contenu'];

$nb_pages = ceil($nombre_messages / $nombre_de_msg_par_page);

if (isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}

$premierMessageAafficher = ($page - 1) * $nombre_de_msg_par_page;

$query = $pdo->prepare('SELECT * FROM produit INNER JOIN salle ON salle.id_salle=produit.id_salle WHERE produit.etat="libre" AND produit.date_arrivee>=:datedujour ORDER BY produit.date_arrivee LIMIT '. $premierMessageAafficher . ', ' . $nombre_de_msg_par_page);
$query->bindValue(':datedujour', date('d-m-Y'), PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();

$querycount = $pdo->prepare('SELECT * FROM produit INNER JOIN salle ON salle.id_salle=produit.id_salle WHERE produit.etat="libre" AND produit.date_arrivee>=:datedujour');
$querycount->bindValue(':datedujour', date('d-m-Y'), PDO::PARAM_STR);
$querycount->execute();
$nRows = $querycount->rowCount();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3">

            <div class="form-group" style="text-align:center;">
                <h2>Recherche</h2>
                <p><a href="<?= $racines ?>">Tout afficher</a></p>
            </div>

            <form>

                <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" id="categorie" onchange="recupPHP()">
                        <option value="" selected>Choisir une catégorie</option>
                        <option value="1">Réunion</option>
                        <option value="2">Bureau</option>
                        <option value="3">Formation</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ville</label>
                    <select class="form-control" id="ville" onchange="recupPHP()">
                        <option value="" selected>Choisir une ville</option>
                        <option value="paris">Paris</option>
                        <option value="lyon">Lyon</option>
                        <option value="marseille">Marseille</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Capacité</label>
                    <input type="range" value="0" min="0" max="1000" step="20" name="capacite" id="capacite" oninput="document.getElementById('AfficheCapacite').textContent=value" onchange="recupPHP()"/>
                    <p>Entre 0 et <span id="AfficheCapacite">0</span> places</p>
                </div>

                <div class="form-group">
                    <label>Prix</label>
                    <input type="range" value="0" min="0" max="5000" step="50" name="prix" id="prix" oninput="document.getElementById('AffichePrix').textContent=value" onchange="recupPHP()"/>
                    <p>Entre 0 € et <span id="AffichePrix">0</span> €</p>
                </div>

                <div class="form-group">
                    <label>Date d'arrivée</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type='text' class="form-control" name="date_arrivee" id="date_arrivee" onchange="recupPHP()" >
                    </div>
                </div>

                <div class="form-group">
                    <label>Date de départ</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type='text' class="form-control" name="date_depart" id="date_depart" onchange="recupPHP()" >
                    </div>
                </div>

            </form>   

        </div>

        <div class="col-sm-9 col-lg-9 col-md-9" id="myDiv">
            <p>Il y a <?= $nRows; ?> produit<?php if($nRows > 1){echo "s";}?> disponible actuellement</p>

            <?php
            foreach ($list as $row) {

                if($row == 1){
                    echo "<p>Le site n'a pas encore de produits</p>";
                }else{
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><img src="<?= $racines; ?>images/<?= $row['photo']; ?>" alt="<?= $row['titre']; ?>"></a>
                            <div class="caption">
                                <h4 class="pull-right"><?= $row['prix']; ?> €</h4>
                                <h4><a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><?= $row['titre']; ?></a>
                                </h4>
                                <p><?= substr($row['description'], 0, 60); ?> ...</p>
                                <p>Du <?= $row['date_arrivee']; ?> au <?= $row['date_depart']; ?></p>
                            </div>
                            
                            <div class="ratings">
                                <p class="pull-right">
                                    <?php
                                    $totalavis = $pdo -> query("SELECT COUNT(note) AS totalnote FROM avis WHERE id_salle='".$row['id_salle']."'");
                                    $totalavis->execute();
                                    $nbavis = $totalavis->fetchAll();                                               

                                    foreach ($nbavis as $rowa) {
                                        if($rowa['totalnote']==0){

                                        }else{
                                            echo $rowa['totalnote'].' avis';
                                        }
                                    }
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    $resultatavis = $pdo -> query("SELECT AVG(note) AS moyenne FROM avis WHERE id_salle='".$row['id_salle']."'");
                                    $resultatavis->execute();
                                    $topavis = $resultatavis->fetchAll();                                               

                                    foreach ($topavis as $rowb) {

                                        if(round($rowb['moyenne'])== 0) {
                                            echo 'Pas de note pour la salle';
                                        }elseif (round($rowb['moyenne']) == 1) {
                                            echo '<i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
                                        }elseif (round($rowb['moyenne']) == 2) {
                                            echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"> </i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
                                        }elseif (round($rowb['moyenne']) == 3) {
                                            echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>';
                                        }elseif (round($rowb['moyenne']) == 4) {
                                            echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>';
                                        }else{
                                            echo '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="col-sm-12 col-lg-12 col-md-12"><?php
                echo 'Page : ';
                for ($i = 1 ; $i <= $nb_pages ; $i++)
                {
                    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                }
                ?>

            </div>
        </div>
    </div>
    <script>
        var ajax = new XMLHttpRequest();
        function recupPHP() {
            var categorie = document.getElementById('categorie').value;
            var ville = document.getElementById('ville').value;
            var capacite = document.getElementById('capacite').value;
            var prix = document.getElementById('prix').value;
            var date_arrivee = document.getElementById('date_arrivee').value;
            var date_depart = document.getElementById('date_depart').value;

            function reponse(data) {
                document.getElementById('myDiv').innerHTML = data;
            }

            function requete(callbackReponse) {
                ajax.onreadystatechange = function () {
                    if(ajax.readyState == 4 && ajax.status == 200)
                    {
                        callbackReponse(ajax.responseText);
                    }
                }
            }
            var parameters="categorie="+categorie+"&ville="+ville+"&capacite="+capacite+"&prix="+prix+"&date_arrivee="+date_arrivee+"&date_depart="+date_depart;
            ajax.open("POST", "<?= $racines; ?>requete.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send(req=parameters);
            requete(reponse);
        }
    </script>
    <?php include('footer.php'); ?>