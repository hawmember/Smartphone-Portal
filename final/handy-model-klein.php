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


                <!-- Handy Model -->
                <div class="handy-model handy-model-klein  <?php echo $specialID; ?>">  <!--attribut muss in eine variable getan werrden -->
                    <!-- Handy Bild -->
                    <div class="handy-img">
                        <img src= <?php echo  $array[0]["URL"]; ?> />
                    </div>

                    <!-- Handy Infos -->
                    <div class="handy-info">
                        <h4>
                          <?php echo  $array[0] ["MODELLNAME"]; ?>
                      </h4>
                        <p class="handy-release">
                          <?php
                            $date = strtotime($array[0] ["ERSCHEINUNGSSDATUM_DEU"]);
                            echo strftime("%A, %d %B %Y", $date);
                          ?>
                        </p>
                        <ul>
                            <?php
                              require_once("in-multiarray.php");
                              require("handy-model-bedingung.php");
                            ?>

                            <li class="bet"><span>Betriebssystem:</span> <?php echo  $array[0] ["AKTUELLES_BETRIEBSSYSTEM"]; ?></span></li>
                            <li class="arb"><span>Arbeitsspeicher:</span> <span><?php echo  $array[0] ["ARBEITSSPEICHER"]. " MB"; ?></span></li>
                            <li class="atot"><span>AnTuTu Benchmark: </span> <span><?php echo $antutuArray["ANTUTU_TOTAL_SCORE"]; ?></span></li>
                            <li class="dtot"><span>DxOMark Kamera Benchmark: </span> <span><?php echo ceil($dxoArray ["DXO_TOTAL_SCORE"] / 2); ?></span></li>
                            <li class="dgro"><span>Display Größe:</span> <span><?php echo $array[0]["DISPLAYGROESSE"]. '"'; ?></span></li>
                            <li class="ama"><span>Amazon:</span> <span class="binaer"><?php echo  $array[0] ["ERHAELTLICHKEIT_AMAZON"]; ?></span></li>
                        </ul>
                    </div>

                    <form method="post" action="detail.php">
                      <input type="hidden" name="aktHandy" value="<?php echo $var; ?>" />
                      <!-- Mehr Erfahren -->
                      <button class="handy-more" type="submit">
                          <div class="circle open">
                              <img src="img/info.png" />
                          </div>
                      </button>
                    </form>
                </div><!-- Handy Model Ende -->
<?php

$verbindung -> close();


 ?>
