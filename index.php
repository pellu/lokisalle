<?php
session_start();
$pagename="Lokisalle";
include('menu.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3">

            <div class="form-group">
                <h2 style="text-align:center;">Recherche</h2>
            </div>

            <form>

                <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" id="categorie" onchange="recupPHP()">
                        <option value="reunion" selected>reunion</option>
                        <option value="bureau">bureau</option>
                        <option value="formation">formation</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ville</label>
                    <select class="form-control" id="ville" onchange="recupPHP()">
                        <option value="Paris" selected>Paris</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Marseille">Marseille</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Capacité</label>
                    <select class="form-control" id="capacite" onchange="recupPHP()">
                        <?php
                        $i= 1;
                        while ($i <= 100) {
                            if ($i == 20)
                               { echo '<option value="' . $i . '" selected >' . $i . '</option>'; }
                           else { echo '<option value="' . $i . '">' . $i . '</option>'; }
                           $i++; } ?>
                       </select>
                   </div>

                   <div class="form-group">
                    <label>Prix</label>
                    <input type="range" min="0" max="1500" step="5" name="prix" id="prix" oninput="document.getElementById('AfficheRange').textContent=value" onchange="recupPHP()"/>
                    <span id="AfficheRange">0</span>
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


            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
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