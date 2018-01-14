<?php
$server = "localhost";
$user = "rdbs1718u02";
$password = "rdbs1718u02";
$db = "rdbs1718u02";

/* MSQL CONNECTION*/
$verbindung = NEW MySQLi($server, $user, $password, $db)
or die ("Fehler im System");
?>


      <?php


      $sql1 = "SELECT * FROM  SMARTPHONE_DATENBLATT, SMARTPHONE_VARIANTEN,ANTUTU_BENCHMARK,DXOMARK_BENCHMARK,RUECKSEITENKAMERA,RUECKSEITENVIDEO,FRONTKAMERA,FRONTVIDEO,SMARTPHONE_BILDER
      WHERE SMARTPHONE_VARIANTEN.MODELLNAME = SMARTPHONE_DATENBLATT.MODELLNAME AND SMARTPHONE_DATENBLATT.MODELLNAME = ANTUTU_BENCHMARK.MODELLNAME AND SMARTPHONE_DATENBLATT.MODELLNAME = DXOMARK_BENCHMARK.MODELLNAME
      AND SMARTPHONE_DATENBLATT.RUECKSEITENKAMERA_MP = RUECKSEITENKAMERA.RUECKSEITENKAMERA_MP AND SMARTPHONE_DATENBLATT.RUECKSEITEN_VIDEOAUFLOESUNG = RUECKSEITENVIDEO.RUECKSEITEN_VIDEOAUFLOESUNG
      AND SMARTPHONE_DATENBLATT.FRONT_KAMERA_MP = FRONTKAMERA.FRONT_KAMERA_MP AND SMARTPHONE_DATENBLATT.FRONT_VIDEOAUFLOESUNG = FRONTVIDEO.FRONT_VIDEOAUFLOESUNG AND  SMARTPHONE_DATENBLATT.MODELLNAME = SMARTPHONE_BILDER.MODELLNAME
      AND (SMARTPHONE_DATENBLATT.MODELLNAME LIKE '$var')"; // VARIABLE muss eingefügt werden
      $result2 = $verbindung->query($sql1);

      // ANTUTU Total Score Berechnung
      $antutu = "SELECT MODELLNAME, CPU_SCORE, UX_SCORE, 3D_SCORE, RAM_SCORE, (CPU_SCORE + UX_SCORE + 3D_SCORE + RAM_SCORE) AS ANTUTU_TOTAL_SCORE FROM ANTUTU_BENCHMARK WHERE ANTUTU_BENCHMARK.MODELLNAME LIKE '$var'";
      $ergebnis = $verbindung->query($antutu);

      // DxOMark Total Score Berechnung
      $dxo = "SELECT MODELLNAME, PHOTO_SCORE,VIDEO_SCORE, (PHOTO_SCORE + VIDEO_SCORE) AS DXO_TOTAL_SCORE FROM DXOMARK_BENCHMARK WHERE DXOMARK_BENCHMARK.MODELLNAME LIKE '$var'";
      $ergebnis2 = $verbindung->query($dxo);


      $array = array();
      $antutuArray = array();
      $dxoArray = array();


        if ($result2->num_rows >0) {
          while ($row = mysqli_fetch_array($result2)) {

            //$i++;
            $array[] = $row ;   // Multidimensionales array eingeführt
            // https://stackoverflow.com/questions/5053857/php-multi-dimensional-array-from-mysql-result link
          }
        }

        while ($antutuRow = mysqli_fetch_array($ergebnis)) {
          $antutuArray = $antutuRow;
        }

        while ($dxoRow = mysqli_fetch_array($ergebnis2)) {
          $dxoArray = $dxoRow;
        }

        ?>

    <!-- Header -->
    <header class="head">
        <div class="inner">
          <a href="index.php" class="back-link">Zurück</a> 
          <h1 style="color: #fff; clear:both;"><?php echo  $array[0] ["MODELLNAME"]; ?></h1>
          <h4 style="color: #fff;">
            <?php
              $date = strtotime($array[0] ["ERSCHEINUNGSSDATUM_DEU"]);
              echo strftime("%A, %d %B %Y", $date);
            ?>
          </h4>
        </div>
    </header>

    <!-- Section -->
    <section class="allcont handy-model-gross">
      <!-- Intro -->
      <div class="gridwrapper">
        <div class="inner">
          <!-- Spalte 1 -->
          <div class="col33">
            <div class="handy-image text-center">
              <img src= <?php echo  $array[0]["URL"]; ?> />
            </div>
            <!-- Bewertung schreiben -->
            <div class="bewertungSchreiben">
              <h4 class="text-center">Bewertung schreiben</h4>
              <form method="post" action="handy-model.php?page=2">
                  <fieldset style="display: none;">
                      <input type="radio" id="phone<?php echo $specialID; ?>" name="phone" value="<?php echo $var ?>" checked>
                      <label for="phone"> phone</label>
                  </fieldset>
                  <div class="star-rating">
                    <fieldset>
                      <input type="radio" id="star5<?php echo $specialID; ?>" name="rating" value="5" /><label for="star5<?php echo $specialID; ?>" title="Outstanding">5 stars</label>
                      <input type="radio" id="star4<?php echo $specialID; ?>" name="rating" value="4" /><label for="star4<?php echo $specialID; ?>" title="Very Good">4 stars</label>
                      <input type="radio" id="star3<?php echo $specialID; ?>" name="rating" value="3" /><label for="star3<?php echo $specialID; ?>" title="Good">3 stars</label>
                      <input type="radio" id="star2<?php echo $specialID; ?>" name="rating" value="2" /><label for="star2<?php echo $specialID; ?>" title="Poor">2 stars</label>
                      <input type="radio" id="star1<?php echo $specialID; ?>" name="rating" value="1" /><label for="star1<?php echo $specialID; ?>" title="Very Poor">1 star</label>
                    </fieldset>
                  </div>
                  <textarea class="bewertungText" name="bewertung" placeholder="Schreibe deine Bewertung..."></textarea>
                  <input class="submitBewertung" type="submit" name="submit" value="Abschicken">
              </form>
            </div>
            <!-- Bewertungen ausgeben -->
            <div class="bewertungAusgeben">
              <h4 class="text-center">Aktuelle Bewertung</h4>
              <?php
                // Bewertung ausgeben  =======================

                // Checken ob eine Bwertung vorhanden ist
                $bewertungStatus = 0;
                $checkBewertung = "SELECT MODELLNAME FROM BEWERTUNG WHERE MODELLNAME = '$var'";
                $checkBewertungAbfrage = $verbindung->query($checkBewertung);
                if($checkBewertungAbfrage->num_rows > 0) {
                      while($row = $checkBewertungAbfrage->fetch_array())
                          {
                              $bewertungStatus++;
                          }
                }
                if($bewertungStatus != 0) {
                    // Hier bekommt man die Summe der Ratings als INT
                    $ratingAbfrage = "SELECT SUM(RATING) AS rating_sum FROM BEWERTUNG WHERE MODELLNAME = '$var'";
                    $starRating = $verbindung->query($ratingAbfrage); 
                    $rowRating = $starRating->fetch_assoc(); 
                    $ratingSum = $rowRating['rating_sum'];

                    // Hier Anzahl der Zeilen durch Summe teilen
                    $durchschnitt = $ratingSum / $bewertungStatus;

                    // Durchschnitt ausgeben
                    if ($durchschnitt > 4.5) { // 5 Sterne
                      echo "<div class='text-center'><span class='star'></span><span class='star'></span><span class='star'></span><span class='star'></span><span class='star'></span></div>";
                    }
                    else if ($durchschnitt > 3.5) { // 4 Sterne
                      echo "<div class='text-center'><span class='star'></span><span class='star'></span><span class='star'></span><span class='star'></span></div>";
                    }
                    else if ($durchschnitt > 2.5) { // 3 Sterne
                      echo "<div class='text-center'><span class='star'></span><span class='star'></span><span class='star'></span></div>";
                    }
                    else if ($durchschnitt > 1.5) { // 2 Sterne
                      echo "<div class='text-center'><span class='star'></span><span class='star'></span></div>";
                    }
                    else if ($durchschnitt > 0) { // 1 Sterne
                      echo "<div class='text-center'><span class='star'></span></div>";
                    }

                    echo "<hr />";


                    // Ausgabe von Bewertungen 
                    $bewertungen = "SELECT RATING, WERTUNGSTEXT, NUTZERNAME FROM BEWERTUNG WHERE MODELLNAME = '$var'";
                    $bewertungenAbfrage = $verbindung->query($bewertungen); 

                    if ($bewertungenAbfrage->num_rows > 0) {
                          while($row = $bewertungenAbfrage->fetch_assoc()) {
                            ?>
                              <div class="wertung">
                            <?php
                              if ($row["RATING"] == 5) { // 5 Sterne
                                echo "<p><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span></p>";
                              }
                              else if ($row["RATING"] == 4) { // 4 Sterne 
                                echo "<p><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span></p>";
                              }
                              else if ($row["RATING"] == 3) { // 3 Sterne
                                echo "<p><span class='star-small'></span><span class='star-small'></span><span class='star-small'></span></p>";
                              }
                              else if ($row["RATING"] == 2) { // 2 Sterne
                                echo "<p><span class='star-small'></span><span class='star-small'></span></p>";
                              }
                              else if ($row["RATING"] == 1) { // 2 Sterne
                                echo "<p>><span class='star-small'></span></p>";
                              }
                              echo "<p style='padding: 0px;'>".$row["WERTUNGSTEXT"]."</p>";
                              echo "<p style='padding: 0px;'><b>von ".$row["NUTZERNAME"]."</b></p>";
                            ?>
                              </div>
                            <?php
                          }
                    }
                }
                else {
                  echo "<p>Es ist keine Bewertung vorhanden</p>";
                }
              ?>
            </div>
          </div>
          <!-- Spalte 2 -->
          <div class="col33">
            <h3>Allgemein</h3>
            <ul>
              <li><span>Hersteller:</span> <span><?php echo $array[0] ["HERSTELLERNAME"]; ?></span></li>
             <?php
                require_once("in-multiarray.php");
                require_once("handy-model-bedingung.php");
              ?>
              <li><span>Speicher erweiterbar:</span> <span class="binaer"><?php echo  $array[0] ["SPEICHER_ERWEITERBAR"]; ?></span></li>
              <li><span>Abmessung:</span> <span><?php echo  $array[0]["ABMESSUNG"]; ?></span></li>
              <li><span>Gewicht:</span> <span><?php echo  $array[0] ["GEWICHT"]. " g"; ?></span></li>
              <li><span>Betriebssystem:</span> <?php echo  $array[0] ["AKTUELLES_BETRIEBSSYSTEM"]; ?></span></li>
            </ul>
            <hr />
            <h3>Kameras</h3>
            <ul>
              <li class="frontKameraMain openMore">
                  Frontkamera
                  <ul>
                      <li><span>Megapixel:</span><span><?php echo  $array[0] ["FRONT_KAMERA_MP"]. " MP"; ?> </span></li>
                      <li><span>Auflösung:</span> <span><?php echo  $array[0]["FRONT_KAMERA_AUFLOESUNG"]; ?></span></li>
                      <li><span>Blitz:</span> <span class="binaer"><?php echo  $array[0] ["FRONT_BLITZ"]; ?></span></li>
                      <li><span>Videoauflösung:</span> <span><?php echo  $array[0] ["FRONT_VIDEOAUFLOESUNG"]; ?></span></li>
                  </ul>
              </li>
              <hr />
              <li class="ruckKameraMain openMore">
                  Rückkamera
                  <ul>
                      <li><span>Megapixel:</span> <span><?php echo  $array[0] ["RUECKSEITENKAMERA_MP"]. " MP"; ?></span></li>
                      <li><span>Auflösung:</span> <span><?php echo  $array[0] ["RUECKSEITENKAMERA_AUFLOESUNG"]; ?></span></li>
                      <li><span>Blitz:</span> <span class="binaer"><?php echo  $array[0] ["RUECKSEITENKAMERA_BLITZ"]; ?></span></li>
                      <li><span>Videoauflösung:</span> <span><?php echo  $array[0] ["RUECKSEITENKAMERA_AUFLOESUNG"]; ?></span></li>
                  </ul>
              </li>
              <hr />
              <li class="dxomarkMain openMore">
                  DxOMark <img src="img/icons/dxo-icon.png"/>
                  <ul>
                      <li><span>Total Score:</span> <span><?php echo ceil($dxoArray ["DXO_TOTAL_SCORE"] / 2); ?></span></li>
                      <li><span>Foto Score:</span> <span><?php echo  $array[0] ["PHOTO_SCORE"]; ?></span></li>
                      <li><span>Video Score:</span> <span><?php echo  $array[0] ["VIDEO_SCORE"]; ?></span></li>
                  </ul>
              </li>
            </ul>
            <hr />
            <h3>Sonstiges</h3>
            <ul>
                <li><span>Mobilfunk:</span> <span><?php echo  $array[0] ["MOBILFUNKSTANDARD"]; ?></span></li>
                <li><span>Anschluss:</span> <span><?php echo  $array[0] ["ANSCHLUSS_AUFLADEN"]; ?></span></li>
                <li><span>Kopfhöreranschluss:</span> <span><?php echo  $array[0] ["KOPFHOERERANSCHLUSS"]; ?></span></li>
                <li><span>Amazon:</span> <span class="binaer"><?php echo  $array[0] ["ERHAELTLICHKEIT_AMAZON"]; ?></span></li>
            </ul>
          </div>
          <!-- Spalte 3 -->
          <div class="col33">
            <h3>Display</h3>
            <ul>
              <li><span>Display Größe:</span> <span><?php echo $array[0]["DISPLAYGROESSE"]. '"'; ?></span></li>
              <li><span>Display Auflösung:</span> <span><?php echo  $array[0] ["DISPLAY_AUFLOESUNG"]; ?></span></li>
              <li><span>Display Art:</span> <span><?php echo  $array[0] ["DISPLAYART"]; ?></span></li>
            </ul>
            <hr />
            <h3>Hardware</h3>
            <ul>
              <li><span>Prozessor:</span> <span><?php echo  $array[0] ["PROZESSOR"]; ?></span></li>
              <li><span>Arbeitsspeicher:</span> <span><?php echo  $array[0] ["ARBEITSSPEICHER"]. " MB"; ?></span></li>
              <li>
                  AnTuTu Benchmark <img src="img/icons/antutu-icon-2.png"/>
                  <ul>
                      <li><span>Total Score:</span> <span><?php echo  $antutuArray["ANTUTU_TOTAL_SCORE"]; ?></span></li>
                      <li><span>CPU Score:</span> <span><?php echo  $array[0] ["CPU_SCORE"]; ?></span></li>
                      <li><span>UX Score:</span> <span><?php echo  $array[0] ["UX_SCORE"]; ?></span></li>
                      <li><span>3D Score:</span> <span><?php echo  $array[0] ["3D_SCORE"]; ?></span></li>
                      <li><span>RAM Score:</span> <span><?php echo  $array[0] ["RAM_SCORE"]; ?></span></li>
                  </ul>
              </li>
            </ul>
            <hr />
            <h3>Akku</h3>
            <ul>
              <li><span>Laufzeit:</span> <span><?php echo  $array[0] ["AKKULAUFZEIT"]; ?></span></li>
              <li><span>Typ:</span> <span><?php echo  $array[0] ["AKKU"]; ?></span></li>
              <li><span>Kapazität:</span> <span><?php echo  $array[0] ["AKKUKAPAZITAET"]; ?></span></li>
              <li><span>Wechselbar:</span> <span class="binaer"><?php echo  $array[0] ["AKKU_WECHSELBAR"]; ?></span></li>
            </ul>
            <hr />
            <h3>Extras</h3>
            <p><?php echo  $array[0] ["EXTRAS"]; ?></p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </section>

<!-- Bewetrtung schreiben -->
<?php
  if(isset($_GET["page"])) {
    if($_GET["page"] == "2") {
      echo "<link rel='stylesheet' href='css/normalize.min.css'>
        <link rel='stylesheet' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
        <link rel='stylesheet' href='css/font-awesome.css'>
        <link rel='stylesheet' href='css/main.css'>

        <script src='js/vendor/modernizr-2.8.3.min.js'></script>
        <script src='js/ityped.js'></script>";
      session_start();
      $rating =  $_POST["rating"];
      $bewertung =  $_POST["bewertung"];
      $handy = $_POST["phone"];
      $username = $_SESSION["username"];

      if(!isset($_SESSION["username"])) {
          $fehler10 = "Bitte melde dich an um eine Bewertung zu schreiben.";
          echo "<script type='text/javascript'>alert('$fehler10');</script>";
          echo "<script type='text/javascript'>window.location = 'index.php';</script>";
      } 
      else {

        // Abfrage ob bewertung besteht
        $controlBewertung = 0;
        $abfrageBewertung = "SELECT MODELLNAME, NUTZERNAME FROM BEWERTUNG WHERE MODELLNAME = '$handy' AND  NUTZERNAME = '$username'";
        $ergebnisBewertung = $verbindung->query($abfrageBewertung);
        while($row = $ergebnisBewertung->fetch_assoc()) {
          $controlBewertung++;
        }

        if($controlBewertung != 0) {
          $fehler6 = "Dieses Smartphone wurde schon einmal bewertet";
          echo "<script type='text/javascript'>alert('$fehler6');</script>";
          echo "<script type='text/javascript'>window.location = 'index.php';</script>";
        }
        else {
          $eintragBewertung = "INSERT INTO BEWERTUNG (RATING, WERTUNGSTEXT, MODELLNAME, NUTZERNAME) VALUES ('$rating', '$bewertung', '$handy', '$username')";

          $eintragenBewertung = $verbindung->query($eintragBewertung);

          if($eintragenBewertung == true) {
            $fehler7 = "Vielen dank für deine Bewertung!";
            echo "<script type='text/javascript'>alert('$fehler7');</script>";
            echo "<script type='text/javascript'>window.location = 'index.php';</script>";
          }
          else {
            $fehler8 = "Fehler im System. Bitte später nochmal versuchen";
            echo "<script type='text/javascript'>alert('$fehler8');</script>";
            echo "<script type='text/javascript'>window.location = 'index.php';</script>";
          }
        }

        $verbindung -> close();

      }
    }
  }
?>

<?php

$verbindung -> close();


 ?>
