<?php
	// Datenbank Verbindung 
	$server = "localhost";
	$user = "rdbs1718u02";
	$password = "rdbs1718u02";
	$db = "rdbs1718u02";

	/* MSQL CONNECTION*/
	$verbindung = NEW MySQLi($server, $user, $password, $db)
	or die ("Fehler im System");


	session_start(); // Cookie um checken ob angemeldet
?>

<html class="no-js" lang="DE">
    <head>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Smartphone Portal</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/ityped.js"></script>
    </head>
    <body class="main-site">

    	<?php
			$var =  $_POST["searchkey"];
            $specialID = "m0";

			// Abfrage ob bewertung besteht
			$controlSuche = 0;
			$abfrageSuche = "SELECT MODELLNAME FROM SMARTPHONE_DATENBLATT WHERE MODELLNAME = '$var'";
			$ergebnisSuche = $verbindung->query($abfrageSuche);
			while($row = $ergebnisSuche->fetch_assoc()) {
				$controlSuche++;
			}

			if($controlSuche == 0) {
                echo "Dieses Smartphone ist nich vorhanden";
			}
			else {
                include("handy-model.php");
			}
    	?>



        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <!-- Einfügen der JS datei -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/main.js"></script>
	</body>
</html>
