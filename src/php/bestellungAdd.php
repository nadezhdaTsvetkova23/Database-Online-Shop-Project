<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

// get parameters from form
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

$success = $database->insertIntoBestellung($b_nummer, $l_id, $knr, $anzahl_pr, $total_preis, $lieferungsdauer, $b_date); 

// Check result
if ($success){
    echo "Operation successfull!";
}
else{
    echo "Error!";
}
?>

<br>
<a href="index.php">
    go back
</a>
