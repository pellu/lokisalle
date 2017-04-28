<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    <?= 'Lokisalle | ' . $pagename ?>
  </title>
  <link href="<?= $racines; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $racinea; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $racines; ?>css/style.css" rel="stylesheet">
  <link href="<?= $racinea; ?>css/jquery-ui.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php if($pageprofil == 'profil'){
        }else{
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
          <?php 
        }
        ?>
      </head>
      <body>