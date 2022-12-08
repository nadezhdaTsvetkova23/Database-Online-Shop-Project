<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$kunde_array = $database->selectAllKunde();
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

  <!-- Display alle Kunde-->
  <h1>Show Kunde</h1>
  <table class="table table-striped table-sm table-hover">
      <thead class="thead-dark">
      <tr>
          <th>Kundennummer</th>
          <th>Name</th>
          <th>Email</th>     
          <th>Telefonnummer</th>  
          <th>Lieferanschrift</th> 
      </tr>
      </thead>

      <?php foreach ($kunde_array as $kunde) : ?>
          <tr>
              <td><?php echo $kunde['KNR']; ?>  </td>
              <td><?php echo $kunde['NAME']; ?>  </td>
              <td><?php echo $kunde['EMAIL']; ?>  </td>   
              <td><?php echo $kunde['TELEFONNR']; ?>  </td>     
              <td><?php echo $kunde['LIEFERANSCHRIFT']; ?>  </td>
          </tr>
      <?php endforeach; ?>
  </table>
</div>

</main>
</body>
</html>