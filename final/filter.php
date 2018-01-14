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

    <body>
        <!-- Header -->
        <header class="head2">
            <div class="inner">
                <a href="index.php" class="back-link">Zurück</a>
            </div>
        </header>
        <!-- Section -->
        <section class="allcont filter-system">
            <!-- Intro -->
            <div class="gridwrapper">
                <div class="inner">
                   <h1>Finde mit den verschiedenen<br />Optionen dein <b>Smartphone</b></h1>
                </div>
            </div>
             <!-- Filter/Sortier System -->
            <div class="gridwrapper">
                <div class="inner">
                    <div class="col25"><!-- Filter Start -->
                        <div class="filter-panel">
                            <h3>Filter</h3>
                            <hr />
                            <div class="filter-inner">
                                <form class="filter-form" id="sortierenBenchmark" method="post" action="filter-sortieren.php">
                                    <!-- Benchmark Checkboxen -->
                                    <div class="filter-bench filter-div">
                                        <label class="blocked-label">Sortiere nach Benchmark</label>
                                        <label class="control control-checkbox">
                                            AnTuTu Benchmark<input value="5" name="sortierung" type="radio" class="antutu"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            DxOMark<input value="6" name="sortierung" type="radio" class="DxOMark"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                    </div>
                                    <!-- Preis Range Slider -->
                                    <div class="filter-pre range-slider filter-div">
                                        <label class="blocked-label">Preis</label>
                                        <input class="filter-range" type="range" value="1320" min="260" max="1320" step="10">
                                        <span class="filter-range-value euro-sign">0</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!-- Speicher Checkboxen -->
                                    <div class="filter-spe filter-div">
                                        <label class="blocked-label">Speicher</label>
                                        <label class="control control-checkbox">
                                            8gb<input type="checkbox" class="8gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            16gb<input type="checkbox" class="16gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            32gb<input type="checkbox" class="32gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            64gb<input type="checkbox" class="64gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            128gb<input type="checkbox" class="128gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            256gb<input type="checkbox" class="256gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                    </div>
                                    <!-- Farbe Checkboxen -->
                                    <div class="filter-spe filter-div">
                                        <label class="blocked-label">Farbe</label>
                                        <label class="control control-checkbox">
                                            Schwarz<input type="checkbox" class="schwarz"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Weiß<input type="checkbox" class="weiss"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Rot<input type="checkbox" class="rot"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Silber<input type="checkbox" class="silber"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Grau<input type="checkbox" class="grau"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Gold<input type="checkbox" class="gold"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Hellblau<input type="checkbox" class="hellblau"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Blau<input type="checkbox" class="blau"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Grün<input type="checkbox" class="gruen"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Rosegold<input type="checkbox" class="rosegold"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Gelb<input type="checkbox" class="gelb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            Pink<input type="checkbox" class="pink"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                    </div>
                                    <!-- Speicher erweiterbar On/ Off Switch -->
                                    <div class="filter-erw filter-div">
                                        <label>Erhältlich auf Amazon</label>
                                        <div class="onoffswitch">
                                             <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
                                            <label class="onoffswitch-label" for="myonoffswitch">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!-- Arbeitsspeicher Checkboxen -->
                                    <div class="filter-arb filter-div">
                                        <label class="blocked-label">Arbeitspeicher</label>
                                        <label class="control control-checkbox">
                                            128mb<input type="checkbox" class="128mb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            256mb<input type="checkbox" class="256mb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            512mb<input type="checkbox" class="512mb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            1gb<input type="checkbox" class="1gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            2gb<input type="checkbox" class="2gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            3gb<input type="checkbox" class="3gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            4gb<input type="checkbox" class="4gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            6gb<input type="checkbox" class="6gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                        <label class="control control-checkbox">
                                            8gb<input type="checkbox" class="8gb"/>
                                            <div class="control_indicator"></div>
                                        </label>
                                    </div>
                                    <!-- Display Range Slider -->
                                    <div class="filter-pre range-slider filter-div">
                                        <label class="blocked-label">Displaygröße</label>
                                        <input class="filter-range" type="range" value="6.5" min="3.5" max="6.2" step="0.1">
                                        <span class="filter-range-value zoll-sign">0</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>&nbsp; <!-- Platz Halter -->
                    </div><!-- Filter Ende -->
                    <!-- Tags -->
                    <div class="col50">
                        <div class="tags-panel">
                            <div class="tags-open">
                                <span>Tags</span>
                            </div>
                            <div class="tags-item-wrap">
                                <ul class="tags-all">
                                    <li class="tag-item">Fingerabdrucksensor</li>
                                    <li class="tag-item">Slowmotion Video</li>
                                    <li class="tag-item">Ultra-Slowmotion Video</li>
                                    <li class="tag-item">Apple Pay</li>
                                    <li class="tag-item">Live-Photos</li>
                                    <li class="tag-item">3D-Touch-Display</li>
                                    <li class="tag-item">Dual-Kamera</li>
                                    <li class="tag-item">Gesichtserkennung</li>
                                    <li class="tag-item">Wasser & Staubdicht</li>
                                    <li class="tag-item">Gorilla Glas</li>
                                    <li class="tag-item">Always On DIsplay</li>
                                    <li class="tag-item">Edge</li>
                                    <li class="tag-item">Bluetooth 4</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col25"><!-- Sortieren Start -->
                    	<form id="sortieren" method="post" action="filter-sortieren.php">
	                        <div class="selected-item">
	                          <div class="option">
	                            <input type="radio" value="0" name="sortierung" />
	                            <p>Sortieren</p>
	                          </div>
	                        </div>
	                        <div class="option-wrap">
	                          <div class="option">
	                            <input type="radio" value="1" name="sortierung" />
	                            <p>Preis: aufsteigend</p>
	                          </div>
	                          <div class="option">
	                            <input type="radio" value="2" name="sortierung" />
	                            <p>Preis: absteigend</p>
	                          </div>
	                          <div class="option">
	                            <input type="radio" value="3" name="sortierung" />
	                            <p>neu nach alt</p>
	                          </div>
	                          <div class="option">
	                            <input type="radio" value="4" name="sortierung" />
	                            <p>alt nach neu</p>
	                          </div>
	                        </div>
                    	</form>
                    </div><!-- Sortieren Ende -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Filter/Sortier System ENDE -->

            <?php 
            	$abfrage = "SELECT MODELLNAME FROM SMARTPHONE_DATENBLATT ORDER BY RAND()";
            	$result = $verbindung->query($abfrage);

            ?>

            <!-- Hand Modele -->
            <div class="gridwrapper" style="margin-top: 45px;">
            	<div class="inner">
	                <div class="inner-filter">
	                	<?php
	                		$handyId = 0;
        	    	        if ($result->num_rows >0) {
		          				while ($row = mysqli_fetch_array($result)) {
      					?>
				                    <div class="col25">
				                        <?php
				                            $var = $row["MODELLNAME"];
				                            $specialID = "m".$handyId;
				                            include("handy-model-klein.php");
				                            $handyId ++;
				                        ?>
				                    </div>
				        <?php
				                }
				            }
			            ?>
	                    <div class="clearfix"></div>
	                </div>
	                <div class="clearfix"></div>
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