<?php
session_start();
$pagename="Lokisalle";
include('menu.php');

$query = $pdo->prepare('SELECT * FROM produit INNER JOIN salle ON salle.id_salle=produit.id_salle WHERE produit.etat="libre" ORDER BY id_produit DESC LIMIT 0, 10');
$query->execute();
$list = $query->fetchAll();

//Compter nombre de résultat
$nRows = $pdo->query('SELECT count(*) FROM produit WHERE produit.etat="libre"')->fetchColumn();
?>
        <script src="<?= $racinea; ?>js/jquery.js"></script>
        <script src="<?= $racinea; ?>js/jquery-ui.js"></script>
        <script>
          $( function() {
            var dateFormat = "dd-mm-yy",
            from = $( "#date_arrivee" )
            .datepicker({
             defaultDate: "+1w",
             minDate: 0,
             changeMonth: true,
             showWeek: true,
             numberOfMonths: 2,
             closeText: "Fermer",
             prevText: "Précédent",
             nextText: "Suivant",
             currentText: "Aujourd\'hui",
             monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
             monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
             dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
             dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
             dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
             weekHeader: "Sem.",
             dateFormat: "dd-mm-yy",
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: true,
             yearSuffix: ""
         })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
          }),
            to = $( "#date_depart" ).datepicker({
             defaultDate: "+1w",
             minDate: 0,
             changeMonth: true,
             showWeek: true,
             numberOfMonths: 2,
             closeText: "Fermer",
             prevText: "Précédent",
             nextText: "Suivant",
             currentText: "Aujourd\'hui",
             monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
             monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
             dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
             dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
             dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
             weekHeader: "Sem.",
             dateFormat: "dd-mm-yy",
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: true,
             yearSuffix: ""
         })
            .on( "change", function() {
                from.datepicker( "option", "maxDate", getDate( this ) );
            });

            function getDate( element ) {
              var date;
              try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }
    } );
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3">

            <div class="form-group" style="text-align:center;">
                <h2>Recherche</h2>
                <p>Il y a <?= $nRows; ?> résultat<?php if($nRows > 1){echo "s";}?></p>
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

            <?php
            foreach ($list as $row) {

                if($row == 1){
                    echo "Le site n'a pas encore de produits";
                }else{
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="<?= $racines; ?>images/<?= $row['photo']; ?>" alt="<?= $row['titre']; ?>">
                            <div class="caption">
                                <h4 class="pull-right"><?= $row['prix']; ?> €</h4>
                                <h4><a href="<?= $racines; ?>fiche_produit/<?= $row['id_produit']; ?>"><?= $row['titre']; ?></a>
                                </h4>
                                <p><?= $row['description']; ?></p>
                                <p>Du <?= $row['date_arrivee']; ?> au <?= $row['date_depart']; ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
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
            ajax.open("POST", "requete.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send(req=parameters);
            requete(reponse);
        }
    </script>
    <?php include('footer.php'); ?>