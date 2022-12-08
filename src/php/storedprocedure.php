<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$fetchData = '';
if(isset($_POST['fetchData'])){
	$fetchData = $_POST['fetchData'];
}

$out = $database->storedProcedure($fetchData);
echo "You removed '{$out}'";

?>

<br> 
<a href = "index.php">
	go back
</a>
	