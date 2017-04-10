    <!-- /.container -->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Lokisalle 2017 - <a href="mentionslegales.php">Mentions Légales</a> - <a href="cgv.php">Conditions générales de ventes</a> - <a href="cgu.php">Conditions générales d'utilisation</a></p>
                </div>
            </div>
        </footer>
    </div>
    <!--Modal de connexion-->
    <div class="modal fade" id="coNnexion" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Connexion</h4>
                </div>
                <div class="modal-body">
                    <p><?php include('connexion.php'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!--Modal de inscription-->
    <div class="modal fade" id="inScription" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Inscription</h4>
                </div>
                <div class="modal-body">
                    <p><?php include('inscription.php'); ?></p>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
</body>
</html>


