<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = 'a11942924'; // use a + your matriculation number
    const password = '0048238490NvNe'; // use your oracle db password
    const con_string = 'oracle-lab.cs.univie.ac.at:1521/lab';

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        // clean up
        oci_close($this->conn);
    }

	//INSERTS
	
	//kunde
	public function insertIntoKunde($knr, $name, $email, $telefonnr, $lieferanschrift){
		$sql = "INSERT INTO kunde VALUES ({$knr}, '{$name}', '{$email}', '{$telefonnr}', '{$lieferanschrift}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//unternehmen
	public function insertIntoUnternehmen($unternehmen_id, $knr, $bereich){
	$sql = "INSERT INTO unternehmen VALUES ('{$unternehmen_id}', '{$knr}', '{$bereich}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//privatkunde
	public function insertIntoPrivatkunde($privatkunde_id, $knr, $gender){
		$sql = "INSERT INTO privatkunde VALUES ('{$privatkunde_id}', '{$knr}', '{$gender}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//zahlung 
	public function insertIntoZahlung($knr, $zahlungsart, $betrag){
		$sql = "INSERT INTO zahlung (knr, zahlungsart, betrag) VALUES ('{$knr}', '{$zahlungsart}', '{$betrag}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//lieferant
	public function insertIntoLieferant($l_id, $name, $tel){
		$sql = "INSERT INTO lieferant (l_id, name, telefon_nr) VALUES ('{$l_id}', '{$name}', '{$tel}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//bestellung
	public function insertIntoBestellung($b_nummer, $l_id, $knr, $anzahl_pr, $total_preis, $lieferungsdauer, $b_date){
		$sql = "INSERT INTO bestellung VALUES ({$b_nummer}, {$l_id}, {$knr}, {$anzahl_pr}, {$total_preis}, '{$lieferungsdauer}', DATE '{$b_date}')";
		$statement = oci_parse($this->conn, $sql);
		$success = @oci_execute($statement) && @oci_commit($this->conn);
		@oci_free_statement($statement);
		return $success;
	}
	
	//SELECTS
	
	//kunde all by name
	public function selectAllKunde(){
		$sql = "SELECT * FROM kunde ORDER BY name";
		$statement = @oci_parse($this->conn, $sql);
		@oci_execute($statement);
		@oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
		@oci_free_statement($statement);
		
		return $res;
	}
	
/*public function storedProcedure($word)
    {
         $sql = 'BEGIN concatenateWords(:name, :message); END;';

         $stmt = oci_parse($this->conn,$sql);

         // Bind the input parameter
         oci_bind_by_name($stmt,':name', $word, 32);
		// Bind the input parameter doppelt
		oci_bind_by_name($stmt,':name', $word, 32);
         // Bind the output parameter
         oci_bind_by_name($stmt,':message',$message, 32);

         oci_execute($stmt);

         // $message is now populated with the output value
         return $message;

    }
	*/
	
	//kunde first 10 rows by knr
	public function selectKunde10Rows($knr, $name, $email, $telefonnr, $lieferanschrift){
		$sql = "SELECT * FROM kunde
            WHERE knr LIKE '%{$knr}%'
              AND upper(name) LIKE upper('%{$name}%')
              AND upper(lieferanschrift) LIKE upper('%{$lieferanschrift}%')
			  AND email LIKE '%{$email}%'
			  AND telefonnr LIKE '%{$telefonnr}%'
            ORDER BY knr ASC
			FETCH FIRST 10 ROWS ONLY";
		
		$statement = @oci_parse($this->conn, $sql);
		@oci_execute($statement);
		@oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
		@oci_free_statement($statement);
		
		return $res;
	}
	
	//kunde only name and email
	public function selectKunde($name){
		if(!$name) { $sql = "SELECT * FROM kunde ORDER BY name"; }
		else { $sql = "SELECT name, email FROM kunde WHERE name LIKE '{$name}'"; }
		$statement = @oci_parse($this->conn, $sql);
		@oci_execute($statement);
		@oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
		@oci_free_statement($statement);
		
		return $res;
	}
	
	//bestellung
	public function selectAllBestellungen(){
		$sql = "SELECT * FROM bestellung ORDER BY total_preis";
		$statement = @oci_parse($this->conn, $sql);
		@oci_execute($statement);
		@oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
		@oci_free_statement($statement);
		
		return $res;
	}
	
	//lieferant
	public function selectLieferant($name){
		if(!$name) { $sql = "SELECT * FROM lieferant ORDER BY l_id"; }
		else { $sql = "SELECT * FROM lieferant WHERE name LIKE '{$name}'"; }
		$statement = @oci_parse($this->conn, $sql);
		@oci_execute($statement);
		@oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
		@oci_free_statement($statement);
		
		return $res;
	}
	
	//UPDATES
	
	//kunde
	public function updateKunde($knr, $name, $email, $telefonnr, $lieferanschrift){ //update specific knr and name with new email, telefonnr and lieferanschrift
		$sql="UPDATE kunde SET name='$name', email='$email', telefonnr='$telefonnr', lieferanschrift = '$lieferanschrift' WHERE knr='$knr'";   
        $statement = @oci_parse($this->conn, $sql);
        $update= @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $update;
	}
	
	//bestellung
	public function updateBestellung($b_nummer, $l_id, $knr, $anzahl_pr, $total_preis, $lieferungsdauer, $b_date){ //update specific knr and name with new email, telefonnr and lieferanschrift
		$sql="UPDATE bestellung SET l_id = $l_id, knr = $knr, anzahl_pr=$anzahl_pr, total_preis=$total_preis, lieferungsdauer = '$lieferungsdauer', b_date = DATE '$b_date' WHERE b_nummer = $b_nummer";    
        $statement = @oci_parse($this->conn, $sql);
        $update= @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $update;
	}
	
	//lieferant
	public function updateLieferant($l_id, $name, $telefon_nr){
		$sql = "UPDATE lieferant SET name = '$name', telefon_nr = '$telefon_nr' WHERE l_id = '$l_id'"; //update specific l_id with new name and phone number
		$statement = @oci_parse($this->conn, $sql);
		$update = @oci_execute($statement) && @oci_commit($this->conn);
		@oc_free_statement($statement);
		return $update;
	}
	
	//DELETES 
	
	//kunde
	public function deleteKunde($knr){
        $sql = "DELETE FROM kunde WHERE knr={$knr}";
        $statement = @oci_parse($this->conn, $sql);
        $delete = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $delete;
    }
	
	//bestellung
	public function deleteBestellung($b_nummer, $l_id, $knr){
        $sql = "DELETE FROM bestellung WHERE b_nummer=$b_nummer AND l_id=$l_id AND knr=$knr";
        $statement = @oci_parse($this->conn, $sql);
        $delete = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $delete;
    }
	
	//lieferant
	public function deleteLieferant($l_id){
        $sql = "DELETE FROM lieferaant WHERE l_id=$l_id";
        $statement = @oci_parse($this->conn, $sql);
        $delete = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $delete;
    }
	
	
    
}
