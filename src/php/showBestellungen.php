<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$bestellung_array = $database->selectAllBestellungen();
?>
<br>
<a href="index.php">
    go back
</a>

<!DOCTYPE html>
<html lang="en">

<body>
<main>
  <br>

  <!-- Display alle bestellung-->
  <h1>Show Bestellung table</h1>
  <table class="table table-striped table-sm table-hover">
      <thead class="thead-dark">
      <tr>
          <th>Bestellnummer</th>
          <th>Lieferantnummer</th>
          <th>bestellungnnummer</th>     
          <th>Anzahl der Produkten</th>  
          <th>Total Preis</th> 
          <th>Lieferungsdauer</th>  
          <th>Bestelldatum</th> 
      </tr>
      </thead>

      <?php foreach ($bestellung_array as $bestellung) : ?>
          <tr>
              <td><?php echo $bestellung['B_NUMMER']; ?>  </td>
              <td><?php echo $bestellung['L_ID']; ?>  </td>
              <td><?php echo $bestellung['KNR']; ?>  </td>   
              <td><?php echo $bestellung['ANZAHL_PR']; ?>  </td>     
              <td><?php echo $bestellung['TOTAL_PREIS']; ?>  </td>
              <td><?php echo $bestellung['LIEFERUNGSDAUER']; ?>  </td>     
              <td><?php echo $bestellung['B_DATE']; ?>  </td>
          </tr>
      <?php endforeach; ?>
  </table>
</div>

</main>
</body>
</html>