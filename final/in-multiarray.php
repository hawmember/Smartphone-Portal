  <?php
  //$elem = das Element aus der Tabelle, $array = das Array, was wir oben erstellt haben ($array[] = $row), $field = die Spalte, die wir ansprechen wollen
  //Sorgt dafür, dass die Einträge nicht doppelt und dreifach ausgegeben werden. Außerdem werden nur die Ergebenisse ausgegeben, die auch wirklich existieren.
  //Bsp: iPhone 4 hat nur 3 Speichervarianten (8,16,32) und 6 Farben. Und es sollen nur 3 mal das ausgegeben werden, egal wie viele Farben da sind.
  function in_multiarray($elem, $array, $field)
{
    $top = sizeof($array) - 1;
    $bottom = 0;
     $temp = 0;
     $temp2 = "farbString";
     $temp3 = 0;
    while($bottom <= $top)
    {
      if($field == "INTERNER_SPEICHER") {
        if($array[$bottom][$field] == $elem) {
          if ($elem != $temp) {
            $temp = $elem;
            ?>
              <span class="speWrap <?php echo $elem; ?>"><?php echo $elem; ?></span>
            <?php
          }
          }
        $bottom++;
      }
      else if($field == "FARBE") {
        if($array[$bottom][$field] == $elem) {
          if ($elem != $temp2) {
            $temp2 = $elem;
            ?>
              <span class="farWrap"><?php echo $elem; ?></span>
            <?php
          }
          }
        $bottom++;
      }
      else if($field == "EINFUEHRUNGSPREIS") {
        if($array[$bottom][$field] == $elem) {
          if ($elem != $temp3) {
            $temp3 = $elem;
            ?>
              <span class="preWrap"><?php echo $elem; ?></span>
            <?php
          }
        }
        $bottom++;
      }
    }
  return false;
  $temp = 0;
  $temp2 = "farbString";
  $temp3 = 0;
  }
  ?>
