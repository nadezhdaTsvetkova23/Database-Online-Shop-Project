<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$knr = '';
if(isset($_POST['knr'])){
    $knr = $_POST['knr'];
}


$name = '';
if(isset($_POST['name'])){
    $name = $_POST['name'];
}

$email = '';
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

$telefonnr = '';
if(isset($_POST['telefonnr'])){
    $telefonnr = $_POST['telefonnr'];
}

$lieferanschrift = '';
if(isset($_POST['lieferanschrift'])){
    $lieferanschrift = $_POST['lieferanschrift'];
}

// Delete method
$error_code = $database->deleteKunde($knr);

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