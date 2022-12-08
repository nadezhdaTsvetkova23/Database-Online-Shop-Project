<!DOCTYPE html>
<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

// Get parameter from GET Request
$knr = '';
if (isset($_GET['knr'])) {
    $knr = $_GET['knr'];
}

$name = '';
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

$email = '';
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

$telefonnr = '';
if(isset($_GET['telefonnr'])){
    $telefonnr = $_GET['telefonnr'];
}

$lieferanschrift = '';
if(isset($_GET['lieferanschrift'])){
    $lieferanschrift = $_GET['lieferanschrift'];
}

//Fetch data from database
$kunde_array = $database->selectAllKunde($knr, $name, $email, $telefonnr, $lieferanschrift);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>Product example · Bootstrap v5.2</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/product/">    

    <style>
	body{
		margin:0;
		padding:0;
		background-color: #C2FFF9
	}
	nav{
		width:100%;
		background: black
		overflow:auto;
	}
	h3{
		
		display:block;
		padding:20px 15px;
		text-decoration:none;
		font-family:Arial;
		color:#f2f2f2;
	}
	h3:hover {
		background:white;
		transition:0.5s;
		text-transformation:uppercase;
	}
	
	
    </style>
	
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5", style = "background-color:pink">
      <h1 class="display-4 fw-normal",  style="text-align:center;background-color:pink;font-size:300%;font-family:helvetica;color:white">Inspire</h1>
      <p class="lead fw-normal", style="text-align:center;background-color:pink;font-size:150%;font-style:italic, bold;font-family:helvetica;color:grey">Be inspired. Be inspiration. Be trendy with INSPIRE. Women Fashion.</p>
      <h3 class="btn btn-outline-secondary" href="#", style = "text-align:center;font-size:100%;font-style:italic;align:center">Coming soon</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>
  </head>
  <body>

<main>
  

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">New Kunde</h2>
        <p class="lead">Fill in the data:</p>
		<form method="post" action="kundeAdd.php">
	<!-- Knr textbox -->
    <div>
        <label for="knr">Kundenummer:</label>
        <input id="knr" name="knr" type="number" maxlength="15">
    </div>
    <br>
	
    <!-- Name textbox -->
    <div>
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" maxlength="62">
    </div>
    <br>

	<!-- Email textbox -->
    <div>
        <label for="email">Email:</label>
        <input id="email" name="email" type="text" maxlength="62">
    </div>
    <br>
	
	<!-- Phone textbox -->
    <div>
        <label for="telefonnr">Handynummer:</label>
        <input id="telefonnr" name="telefonnr" type="text" maxlength="25">
    </div>
    <br>
	
	<!-- Address textbox -->
    <div>
        <label for="lieferanschrift">Lieferanschrift:</label>
        <input id="lieferanschrift" name="lieferanschrift" type="text" maxlength="220">
    </div>
    <br>
    

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add
        </button>
    </div>
</form>
      </div>
      
	  </div>
    </div>
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Delete Kunde</h2>
        
		<form method="post" action="kundeDel.php">
    <!-- ID textbox -->
    <div>
        <label for="del_knr">Kundenummer:</label>
        <input id="del_knr" name="knr" type="number" min="0">
    </div>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Delete
        </button>
    </div>
</form>
      </div>
    </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-primary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Edit Kunde data</h2>
		<form method="post" action="updateKunde.php">
		<!-- Knr textbox -->
    <div>
        <label for="knr">Kundenummer:</label>
        <input id="knr" name="knr" type="number" maxlength="20">
    </div>
    <br>
	
    <!-- Name textbox -->
    <div>
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" maxlength="40">
    </div>
    <br>

	<!-- Email textbox -->
    <div>
        <label for="emai;">Email:</label>
        <input id="email" name="email" type="text" maxlength="60">
    </div>
    <br>
	
	<!-- Phone textbox -->
    <div>
        <label for="telefonnr">Handynummer:</label>
        <input id="telefonnr" name="telefonnr" type="text" maxlength="40">
    </div>
    <br>
	
	<!-- Address textbox -->
    <div>
        <label for="lieferanschrift">Lieferanschrift:</label>
        <input id="lieferanschrift" name="lieferanschrift" type="text" maxlength="100">
    </div>
    <br>
    

    <!-- Submit button -->
    <div>
        <button type="submit">
            Update
        </button>
    </div>
</form>
      </div>
    </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Show Kunde data</h2>
		
		<form method="get" action = "showKunde.php">
        <!--Show Kunde button -->
		<div>
        <button type="submit">
            Show all Kunde data
        </button>
    </div>
	</form>
	
      </div>
    </div>
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">New Bestellung</h2>
		<form method="post" action = "bestellungAdd.php">
		<!-- b_nummer textbox -->
    <div>
        <label for="b_nummer">Bestellnummer:</label>
        <input id="b_nummer" name="b_nummer" type="number" maxlength="20">
    </div>
    <br>
		<!-- l_id textbox -->
    <div>
        <label for="l_id">Lieferantnummer:</label>
        <input id="l_id" name="l_id" type="number" maxlength="20">
    </div>
    <br>
	<!-- Knr textbox -->
    <div>
        <label for="knr">Kundenummer:</label>
        <input id="knr" name="knr" type="number" maxlength="20">
    </div>
	<br>
    <!-- anzahl_pr textbox -->
    <div>
        <label for="anzahl_pr">Anzahl der Produkten:</label>
        <input id="anzahl_pr" name="anzahl_pr" type="number" maxlength="40">
    </div>
    <br>

	<!-- Total_preis textbox -->
    <div>
        <label for="total_preis;">Total Preis:</label>
        <input id="total_preis" name="total_preis" type="text" maxlength="60">
    </div>
    <br>
	
	<!-- Lieferungsdauer textbox -->
    <div>
        <label for="lieferungsdauer">Handynummer:</label>
        <input id="lieferungsdauer" name="lieferungsdauer" type="text" maxlength="40">
    </div>
    <br>
	
	<!-- b_date textbox -->
    <div>
        <label for="b_date">Lieferanschrift:</label>
        <input id="b_date" name="b_date" type="date" maxlength="100">
    </div>
    <br>
    

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add
        </button>
    </div>
</form>
      </div>
   </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Delete Bestellung</h2>
		<form method="post" action = "bestellungDel.php">
		<!-- b_nummer textbox -->
    <div>
        <label for="b_nummer">Bestellnummer:</label>
        <input id="b_nummer" name="b_nummer" type="number" maxlength="20">
    </div>
    <br>
		<!-- l_id textbox -->
    <div>
        <label for="l_id">Lieferantnummer:</label>
        <input id="l_id" name="l_id" type="number" maxlength="20">
    </div>
    <br>
	<!-- Knr textbox -->
    <div>
        <label for="knr">Kundenummer:</label>
        <input id="knr" name="knr" type="number" maxlength="20">
    </div>
	<br>
    

    <!-- Submit button -->
    <div>
        <button type="submit">
            Delete
        </button>
    </div>
	</form>
      </div>
     </div>
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Edit Bestellung</h2>
		<form method="post" action = "bestellungUpdate.php">
		<!-- b_nummer textbox -->
	<div>
        <label for="b_nummer">Bestellnummer:</label>
        <input id="b_nummer" name="b_nummer" type="number" maxlength="20">
	</div>
	<br>
		
		<!-- l_id textbox -->
    <div>
        <label for="l_id">Lieferantnummer:</label>
        <input id="l_id" name="l_id" type="number" maxlength="20">
    </div>
    <br>
	<!-- Knr textbox -->
    <div>
        <label for="knr">Kundenummer:</label>
        <input id="knr" name="knr" type="number" maxlength="20">
    </div>
	<br>
    <!-- anzahl_pr textbox -->
    <div>
        <label for="anzahl_pr">Anzahl der Produkten:</label>
        <input id="anzahl_pr" name="anzahl_pr" type="number" maxlength="40">
    </div>
    <br>

	<!-- Total_preis textbox -->
    <div>
        <label for="total_preis;">Total Preis:</label>
        <input id="total_preis" name="total_preis" type="text" maxlength="60">
    </div>
    <br>
	
	<!-- Lieferungsdauer textbox -->
    <div>
        <label for="lieferungsdauer">Lieferungsdauer:</label>
        <input id="lieferungsdauer" name="lieferungsdauer" type="text" maxlength="22">
    </div>
    <br>
	
	<!-- b_date textbox -->
    <div>
        <label for="b_date">Bestelldatum:</label>
        <input id="b_date" name="b_date" type="date" maxlength="100">
    </div>
    <br>
    

    <!-- Submit button -->
    <div>
        <button type="submit">
            Update
        </button>
    </div>
      </div>
   </div>
  </div>
  </form>
  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Show Bestellung data</h2>
		
		<form method="get" action = "showBestellungen.php">
        <!--Show Kunde button -->
		<div>
        <button type="submit">
            Show all Bestellung data
        </button>
    </div>
	</form>
      </div>
    </div>
  </div>
  
  <div>
  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Stored Procedure - Remove Kunde </h2>
		
		<form method="post" action = "storedprocedure.php">
       
		<div>
			<label for ="fetchData"> Type a knr to search the name: </label>
			<input id = "fetchData" name = "fetchData" type = "number" maxlength="20">
		</div>
		<br>
		<div>
		<button type = "submit">
			Show Name:
        </button>
		</div>
	</form>
      </div>
    </div>
  </div>
  </div>
  
</main>
<br>



<footer class="container py-5">
  <div class="row">
    <div class="col-12 col-md">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
      <small class="d-block mb-3 text-muted">&copy; 2020–2022</small>
    </div>
    <div class="col-6 col-md">
      <h5>Mehr</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary" href="#">Feedback</a></li>
        <li><a class="link-secondary" href="#">Careers</a></li>
        <li><a class="link-secondary" href="#">Datenschutz</a></li>
        <li><a class="link-secondary" href="#">Hilfe</a></li>
        <li><a class="link-secondary" href="#">Bestellung retournieren</a></li>
        <li><a class="link-secondary" href="#">Kontakt</a></li>
      </ul>
    </div>
  </div>
</footer>
      
  </body>
</html>
