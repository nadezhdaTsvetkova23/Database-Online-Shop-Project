<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

// get parameters from form
$knr = '';
if (isset($_POST['knr'])) {
    $knr = $_POST['knr'];
}

$name = '';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}

$email = '';
if (isset($_POST['email'])) {
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

$success = $database->insertIntoKunde($knr, $name, $email, $telefonnr, $lieferanschrift); 

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
