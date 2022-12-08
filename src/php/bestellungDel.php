<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$b_nummer = '';
if (isset($_POST['b_nummer'])) {
    $b_nummer = $_POST['b_nummer'];
}

$l_id = '';
if (isset($_POST['l_id'])) {
    $l_id = $_POST['l_id'];
}

$knr = '';
if (isset($_POST['knr'])) {
    $knr = $_POST['knr'];
}

$anzahl_pr = '';
if (isset($_POST['anzahl_pr'])) {
    $anzahl_pr = $_POST['anzahl_pr'];
}

$total_preis = '';
if(isset($_POST['total_preis'])){
    $total_preis = $_POST['total_preis'];
}

$lieferungsdauer = '';
if(isset($_POST['lieferungsdauer'])){
    $lieferungsdauer = $_POST['lieferungsdauer'];
}

$b_date = '';
if(isset($_POST['b_date'])){
    $b_date = $_POST['b_date'];
}

// Delete method
$error_code = $database->deleteBestellung($b_nummer, $l_id, $knr);

// Check result
if ($error_code){
    echo "Kunde with knr: {$knr} successfully deleted!'";
}
else{
    echo "Error can't delete Kunde with knr: {$knr}. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>