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
	$verhalten = 0;
	if(!isset($_SESSION["username"]) and !isset($_GET["page"])) {
		$verhalten = 0;
	} else {
        echo "<script type='text/javascript'>window.location = 'index-logged.php';</script>";
    }
?>

<!-- PHP anmelden -->
<?php
	if (isset($_GET["page"]) && ($_GET["page"]) == "log") {

		$user = strtolower($_POST["user"]);
		$passwort = md5($_POST["passwort"]);

		$controlAnmeldung = 0;
		$abfrageAnmeldung = "SELECT * FROM NUTZER WHERE NAME = '$user' AND PASSWORT = '$passwort'";
		$ergebnisAnmeldung = $verbindung->query($abfrageAnmeldung);
		while($row = $ergebnisAnmeldung->fetch_assoc())
			{
				$controlAnmeldung++;
			}

		if($controlAnmeldung != 0) {
			$_SESSION["username"] = $user;
			$verhalten = 1;
		}
		else {
			$verhalten = 2;
		}
	}

	if($verhalten == 2) { 
		$fehler5 = "Fehler beim einloggen. Bitte nochmal versuchen";
		echo "<script type='text/javascript'>alert('$fehler5');</script>";
	}
	else {

	}
?>

<!doctype html>
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
        <!-- Header -->
        <header class="head">
            <div class="inner">
            	<?php
					if($verhalten == 0 || $verhalten == 2) {
				?>
	                <div class="signIn sign">
	                    <a class="signIn-button">Anmelden</a>
	                    <div class="sign-panel">
	                        <div class="inner">
	                            <p>Melde dich an und finde dein passendes Smartphone</p>
	                            <form method="post" action="index.php?page=log">
	                                <input type="text" name="user" placeholder="Benutzername:">
	                                <input type="password" name="passwort" placeholder="Passwort:">
	                                <input class="submit" type="submit" name="submit" value="Anmelden">
	                            </form>
	                        </div>
	                    </div>
	                </div>
	                <div class="signUp sign">
	                    <a class="signUp-button">Registrieren</a>
	                    <div class="sign-panel">
	                        <div class="inner">
	                            <form method="post" action="index.php?page=2">
	                                <input type="text" name="user-neu" placeholder="Benutzername:">
	                                <input type="password" name="pw-neu" placeholder="Passwort:">
	                                <input type="password" name="pwRepeat" placeholder="Passwort wiederholen:">
	                                <input class="submit" type="submit" name="submit" value="Registrieren">
	                            </form>
	                        </div>
	                    </div>
	                </div>
                    <!-- PHP register -->
                    <?php
                    if(isset($_GET["page"])) {
                        if($_GET["page"] == "2") {
                            $user = strtolower($_POST["user-neu"]);
                            $pw = md5($_POST["pw-neu"]);
                            $pw2 = md5($_POST["pwRepeat"]);

                            if($pw != $pw2) {
                                $fehler1 = "Passwörter stimmen nicht überein. Bitte wiederholen";
                                echo "<script type='text/javascript'>alert('$fehler1');</script>";
                            }
                            else {
                                    


                                $controlRegist = 0;
                                $abfrageRegist = "SELECT NAME FROM NUTZER WHERE NAME = '$user'";
                                $ergebnisRegist = $verbindung->query($abfrageRegist);
                                if($ergebnisRegist->num_rows > 0) {
                                    while($row = $ergebnisRegist->fetch_array())
                                        {
                                            $controlRegist++;
                                        }
                                }
                                if($controlRegist != 0) {
                                    $fehler2 = "Username ist vergeben. Bitte ändern";
                                    echo "<script type='text/javascript'>alert('$fehler2');</script>";
                                }
                                else {

                                    $eintragRegist = "INSERT INTO NUTZER (NAME, PASSWORT) VALUES ('$user', '$pw')";

                                    $eintragenRegist = $verbindung->query($eintragRegist);

                                    if($eintragenRegist == true) {
                                        $fehler3 = "Vielen dank für die Registrierung!";
                                        echo "<script type='text/javascript'>alert('$fehler3');</script>";
                                    } 
                                    else {
                                        $fehler4 = "Fehler im System. Bitte später nochmal versuchen";
                                        echo "<script type='text/javascript'>alert('$fehler4');</script>";
                                    }
                                }
                                $verbindung -> close();

                            }
                        }    
                    }
                    ?>
                    
                    <div class="typed-text">
                    	<span id="ityped" class="ityped"></span>
                	</div>
            	<?php
					}
					if($verhalten == 1) {
				?>
					<meta http-equiv="refresh" content="3; URL=index-logged.php" />
                    <a href="logout.php" style="opacity: 0; visibility: hidden;" class="back-link">Abmelden</a> <!-- Abmelden -->
                    <h1 style="color: #fff; clear:both;">Erfolgreich...</h1>
				<?php 
					}
				?>
            </div>
        </header>
        <!-- Section -->
        <section class="allcont">
            <!-- Intro -->
            <div class="gridwrapper">
                <div class="inner">
                    <div class="col33">&nbsp;</div>
                    <div class="col66">
                        Ein Smartphone ist ein Mobiltelefon (umgangssprachlich Handy), das erheblich umfangreichere Computer-Funktionalitäten und -konnektivität als ein herkömmliches „reines“ Mobiltelefon zur Verfügung stellt. Erste Smartphones vereinigten die Funktionen eines Personal Digital Assistant (PDA) bzw. Tabletcomputers mit der Funktionalität eines Mobiltelefons. Später wurde dem kompakten Gerät auch noch die Funktion eines transportablen Medienabspielgerätes, einer Digital- und Videokamera und eines GPS-Navigationsgeräts hinzugefügt.
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Filter -->
            <div class="gridwrapper">
                <div class="inner">
                    <h3 style="margin-bottom: 45px;" class="text-center">Nutze unsere Filter um schneller das passende Smartphone zu finden</h3>
                    <div class="col25">
                        <div class="col25">
                            <img width="100%" height="auto" src="img/icons/money.png" />
                        </div>
                        <div class="col75">
                            <h3 style="padding: 0px;">Einführungspreis</h3>
                            <p><a class="underline" href="filter.php">Los gehts</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col25">
                        <div class="col25">
                            <img width="100%" height="auto" src="img/icons/cpu.png" />
                        </div>
                        <div class="col75">
                            <h3 style="padding: 0px;">Arbeitsspeicher</h3>
                            <p><a class="underline" href="filter.php">Los gehts</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col25">
                        <div class="col25">
                            <img width="100%" height="auto" src="img/icons/display.png" />
                        </div>
                        <div class="col75">
                            <h3 style="padding: 0px;">Display Größe</h3>
                            <p><a class="underline" href="filter.php">Los gehts</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col25">
                        <div class="col25">
                            <img width="100%" height="auto" src="img/icons/speicher.png" />
                        </div>
                        <div class="col75">
                            <h3 style="padding: 0px;">Speicher</h3>
                            <p><a class="underline" href="filter.php">Los gehts</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Suchleiste -->
            <div class="gridwrapper wrapper-img">
                <div class="inner">
                    <div class="col text-center">
                        <h3 style="color: #fff;">Suche nach beliebigen Smartphones</h3>
                        <form class="search-form" method="post" action="search.php">
                            <input type="text" class="search-input" name="searchkey" placeholder="Suche nach einem Smartphone" onkeypress="SplitChar(this.id);">
                            <script type="text/javascript">
        						function SplitChar(txt) {
            						var unicode = event.keyCode ? event.keyCode : event.charCode
            						var character = String.fromCharCode(unicode);
            						var Data = "Welcome 2011".split('');
            						var charLen = document.getElementById(txt).value;
            						if (character == Data[charLen.length]) {
                						event.returnValue = true;
                					}
            						else {
                						event.returnValue = false;
                					}
        						}
							</script>
                            <input class="submit" type="image" src="img/search-icon.png" alt="Submit Form" />
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>

           <!-- Apple Handys-->
            <div class="gridwrapper">
                <div class="inner">
                    <h2 class="text-center">Apple</h2>
                    <div class="col25">
                        <?php
                            $var = "iPhone X";
                            $specialID = "m0";
                            include("handy-model-klein.php");

                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "iPhone 8";
                            $specialID = "m1";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "iPhone 7";
                            $specialID = "m2";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "iPhone 6S";
                            $specialID = "m3";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <form class="text-center" method="post" action="hersteller.php">
                        <fieldset style="display: none;">
                          <input type="radio" name="hersteller" value="Apple" checked>
                          <label for="hersteller"> Apple</label>
                        </fieldset>
                        <a style="font-size: 26px; margin-top: 35px;" class="underline">
                            <input class="underline" type="submit" name="submit" value="Mehr Geräte von Apple">
                        </a>
                    </form>
                </div>
            </div>

            <!-- Samsung Handys-->
            <div class="gridwrapper">
                <div class="inner">
                    <h2 class="text-center">Samsung</h2>
                    <div class="col25">
                        <?php
                            $var = "Samsung Galaxy S8";
                            $specialID = "m4";
                            include("handy-model-klein.php");

                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Samsung Galaxy S7";
                            $specialID = "m5";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Samsung Galaxy S6";
                            $specialID = "m6";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Samsung Galaxy S5";
                            $specialID = "m7";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <form class="text-center" method="post" action="hersteller.php">
                        <fieldset style="display: none;">
                          <input type="radio" name="hersteller" value="Samsung" checked>
                          <label for="hersteller"> Samsung</label>
                        </fieldset>
                        <a style="font-size: 26px; margin-top: 35px;" class="underline">
                            <input class="underline" type="submit" name="submit" value="Mehr Geräte von Samsung">
                        </a>
                    </form>
                </div>
            </div>

            <!-- OnePlus Handys-->
            <div class="gridwrapper">
                <div class="inner">
                    <h2 class="text-center">OnePlus</h2>
                    <div class="col25">
                        <?php
                            $var = "OnePlus 5";
                            $specialID = "m8";
                            include("handy-model-klein.php");

                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "OnePlus 3T";
                            $specialID = "m9";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "OnePlus 3";
                            $specialID = "m10";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "OnePlus X";
                            $specialID = "m11";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <form class="text-center" method="post" action="hersteller.php">
                        <fieldset style="display: none;">
                          <input type="radio" name="hersteller" value="OnePlus" checked>
                          <label for="hersteller"> OnePlus</label>
                        </fieldset>
                        <a style="font-size: 26px; margin-top: 35px;" class="underline">
                            <input class="underline" type="submit" name="submit" value="Mehr Geräte von OnePlus">
                        </a>
                    </form>
                </div>
            </div>

            <!-- HTC Handys-->
            <div class="gridwrapper">
                <div class="inner">
                    <h2 class="text-center">HTC</h2>
                    <div class="col25">
                        <?php
                            $var = "HTC U11";
                            $specialID = "m12";
                            include("handy-model-klein.php");

                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "HTC 10";
                            $specialID = "m13";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "HTC One M9";
                            $specialID = "m14";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "HTC One M8";
                            $specialID = "m15";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <form class="text-center" method="post" action="hersteller.php">
                        <fieldset style="display: none;">
                          <input type="radio" name="hersteller" value="HTC" checked>
                          <label for="hersteller"> HTC</label>
                        </fieldset>
                        <a style="font-size: 26px; margin-top: 35px;" class="underline">
                            <input class="underline" type="submit" name="submit" value="Mehr Geräte von HTC">
                        </a>
                    </form>
                </div>
            </div>

            <!-- Sony Handys-->
            <div class="gridwrapper">
                <div class="inner">
                    <h2 class="text-center">Sony</h2>
                    <div class="col25">
                        <?php
                            $var = "Sony Xperia X";
                            $specialID = "m16";
                            include("handy-model-klein.php");

                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Sony Xperia Z5";
                            $specialID = "m17";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Sony Xperia Z3+";
                            $specialID = "m18";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="col25">
                        <?php
                            $var = "Sony Xperia Z3";
                            $specialID = "m19";
                            include("handy-model-klein.php");
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <form class="text-center" method="post" action="hersteller.php">
                        <fieldset style="display: none;">
                          <input type="radio" name="hersteller" value="Sony" checked>
                          <label for="hersteller"> Sony</label>
                        </fieldset>
                        <a style="font-size: 26px; margin-top: 35px;" class="underline">
                            <input class="underline" type="submit" name="submit" value="Mehr Geräte von Sony">
                        </a>
                    </form>
                </div>
            </div>
        </section>

        <footer> 
            <div class="inner text-center">
                Erstellt von:
            </div>
            <div class="inner">
                <div class="col33 text-center">Kevin Brandao da Graca</div>
                <div class="col33 text-center">Sean Gocks</div>
                <div class="col33 text-center">Daniyal Hussain</div>
                <div class="clearfix"></div>
            </div>
        </footer>

        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <!-- Einfügen der JS datei -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/main.js"></script>
	</body>
</html>




