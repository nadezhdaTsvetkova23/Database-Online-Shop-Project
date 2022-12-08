import java.sql.*;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.List;

public class DatabaseHelper {
	// public static void main(String[] args) throws Exception {
	static final DecimalFormat df = new DecimalFormat("0.00");
	// Connection details
	private static final String url = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
	private static final String user = PrivateSensitive.USER;
	private static final String password = PrivateSensitive.PASS; // saved in separate class for sensitive data

	// We need only one Connection and one Statement during the execution => class
	// variable
	private static Statement stmt;
	private static Connection con;

	private static final String CLASSNAME = "oracle.jdbc.driver.OracleDriver";

	// CREATE CONNECTION
	DatabaseHelper() {
		try {
			// Loads the class "oracle.jdbc.driver.OracleDriver" into the memory
			Class.forName(CLASSNAME);

			// establish connection to database
			con = DriverManager.getConnection(url, user, password);
			stmt = con.createStatement();

		} catch (Exception e) {
			e.printStackTrace();
		}
	}

//INSERTS

	void insertCustomer(String knr, String name, String email, String telefonnr, String lieferanschrift) {
		try {
			// create insert statement
			String insert = "INSERT INTO kunde VALUES (" + Long.parseLong(knr) + ",'" + name + "', '" + email + "', '"
					+ telefonnr + "', '" + lieferanschrift + "')";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert customer: ERROR");
			e.printStackTrace();
		}
	}

	void insertCompany(String unternehmen_id, String knr, String bereich) { //knr is foreign key for unternehmen
		try {
			String insert = "INSERT INTO unternehmen VALUES ('" + unternehmen_id + "', " + Long.parseLong(knr) + ", '"
					+ bereich + "')";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert company: ERROR");
			e.printStackTrace();
		}
	}

	void insertPrivateCustomer(String privatkunde_id, String knr, String gender) {
		try {
			String insert = "INSERT INTO privatkunde VALUES (" + Integer.parseInt(privatkunde_id) + ", "
					+ Integer.parseInt(knr) + ", '" + gender + "')";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert private customer: ERROR");
			e.printStackTrace();
		}
	}

	// z_nummer is created by auto increment with trigger
	void insertPayment(String knr, String zahlungsart, String betrag) {
		try {
			String insert = "INSERT INTO zahlung (knr, zahlungsart, betrag) VALUES (" + Long.parseLong(knr) + ", '" + zahlungsart + "', "
					+ Double.parseDouble(betrag) + ")";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert payment: ERROR");
			e.printStackTrace();
		}
	}

	void insertLieferant(String l_id, String name, String telefon_nr) {
		try {
			String insert = "INSERT INTO lieferant VALUES (" + Long.parseLong(l_id) + ", '" + name + "', '"
					+ telefon_nr + "')";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert Lieferant: ERROR");
			e.printStackTrace();
		}
	}

	void insertOrder(String b_nummer, String l_id, String knr, String anzahl_pr, String total_preis,
			String lieferungsdauer, String b_date) {
		try {
			String insert = "INSERT INTO bestellung VALUES (" + Long.parseLong(b_nummer) + ", "
					+ Long.parseLong(l_id) + ", " + Long.parseLong(knr) + ", " + Integer.parseInt(anzahl_pr) + ", "
					+ df.format(Double.parseDouble(total_preis)) + ", '" + lieferungsdauer + "', DATE '" + b_date + "')";
			stmt.execute(insert);
		} catch (Exception e) {
			System.err.println("Insert order: ERROR");
			e.printStackTrace();
		}
	}

//	void insertLead(String lieferant1, String lieferant2) {
//		try {
//			String insert = "INSERT INTO leitet VALUES (" + Integer.parseInt(lieferant1) + ", "
//					+ Integer.parseInt(lieferant2) + ")";
//			stmt.execute(insert);
//		} catch (Exception e) {
//			System.err.println("Insert lead: ERROR");
//			e.printStackTrace();
//		}
//	}
//
//	void insertProduct(String p_id, String knr, String name, String beschreibung, String preis) {
//		try {
//			String insert = "INSERT INTO produkt VALUES (" + Integer.parseInt(p_id) + ", " + Integer.parseInt(knr)
//					+ ", '" + name + "', '" + beschreibung + "', " + Double.parseDouble(preis) + ")";
//			stmt.execute(insert);
//		} catch (Exception e) {
//			System.err.println("Insert product: ERROR");
//			e.printStackTrace();
//		}
//	}
//
//	// rechnungsnummer GENERATED BY DEFAULT AS IDENTITY -> is created
//	void insertBill(String b_nummer, String betrag, String steuersatz) {
//		try {
//			String insert = "INSERT INTO rechnung VALUES (" + Integer.parseInt(b_nummer) + ", "
//					+ Double.parseDouble(betrag) + ", " + Integer.parseInt(steuersatz) + ")";
//			stmt.execute(insert);
//		} catch (Exception e) {
//			System.err.println("Insert bill: ERROR");
//			e.printStackTrace();
//		}
//	}
//
//	void insertOrdered(String knr, String b_nummer, String p_id) {
//		try {
//			String insert = "INSERT INTO bestellt VALUES (" + Integer.parseInt(knr) + ", " + Integer.parseInt(b_nummer)
//					+ ", " + Integer.parseInt(p_id) + ")";
//			stmt.execute(insert);
//		} catch (Exception e) {
//			System.err.println("Insert ordered: ERROR");
//			e.printStackTrace();
//		}
//	}

//COUNT   
	public void countAlltables() { // TODO precompiled
		int result = 0;
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM kunde"); // counts rows of a table and print result
			if (rs.next())
				result = rs.getInt(1); // do this for each table
			System.out.println("Kunde Count: " + result);

			rs = stmt.executeQuery("SELECT COUNT(*) FROM unternehmen");
			if (rs.next())
				result = rs.getInt(1);
			System.out.println("Unternehmen Count: " + result);

			rs = stmt.executeQuery("SELECT COUNT(*) FROM privatkunde");
			if (rs.next())
				result = rs.getInt(1);
			System.out.println("Privatkunde Count: " + result);

			rs = stmt.executeQuery("SELECT COUNT(*) FROM zahlung");
			if (rs.next())
				result = rs.getInt(1);
			System.out.println("Zahlung Count: " + result);

			rs = stmt.executeQuery("SELECT COUNT(*) FROM lieferant");
			if (rs.next())
				result = rs.getInt(1);
			System.out.println("Lieferant Count: " + result);

			rs = stmt.executeQuery("SELECT COUNT(*) FROM bestellung");
			if (rs.next())
				result = rs.getInt(1);
			System.out.println("Bestellung Count: " + result);

//			rs = stmt.executeQuery("SELECT COUNT(*) FROM leitet");
//			if (rs.next())
//				result = rs.getInt(1);
//			System.out.println("Leitet Count: " + result);
//
//			rs = stmt.executeQuery("SELECT COUNT(*) FROM produkt");
//			if (rs.next())
//				result = rs.getInt(1);
//			System.out.println("Produkt Count: " + result);
//
//			rs = stmt.executeQuery("SELECT COUNT(*) FROM rechnung");
//			if (rs.next())
//				result = rs.getInt(1);
//			System.out.println("Rechnung Count: " + result);
//
//			rs = stmt.executeQuery("SELECT COUNT(*) FROM bestellt");
//			if (rs.next())
//				result = rs.getInt(1);
//			System.out.println("Bestellt Count: " + result);

		} catch (Exception e) {
			System.out.println("COUNT ERROR: ");
			e.printStackTrace();
		}
	}

//DELETE
	void deleteAllEntries() { // TODO precompiled
		try {								//the order is important! -> it can cause problems with foreign keys
			String delete = "DELETE FROM rechnung";	// delete all entries of a table
			stmt.execute(delete);			// do this for each table
			
			delete = "DELETE FROM bestellung";
			stmt.execute(delete);
			
			delete = "DELETE FROM leitet";
			stmt.execute(delete);
			
			delete = "DELETE FROM lieferant";
			stmt.execute(delete);
			
			delete = "DELETE FROM bestellt";
			stmt.execute(delete);
			
			delete = "DELETE FROM produkt";
			stmt.execute(delete);
			
			delete = "DELETE FROM unternehmen";
			stmt.execute(delete);

			delete = "DELETE FROM privatkunde";
			stmt.execute(delete);

			delete = "DELETE FROM zahlung";
			stmt.execute(delete);
			
			delete = "DELETE FROM kunde"; 
			stmt.execute(delete); 
			

		} catch (Exception e) {
			System.err.println("DELETE entries ERROR: ");
			e.printStackTrace();
		}
	}
	
//SELECT
	
	//!!!
    //returns list of zahlung PK(z_nummer)
    //needed, because z_nummer is created by trigger
    //retrieved as a String to keep type consistency across key-lists
   
	List<String> selectIdFromPayment(){
    	List<String> IDs = new ArrayList<>();
    	try {
    		ResultSet rs = stmt.executeQuery("SELECT z_nummer FROM zahlung");
    		while(rs.next()) 
    			IDs.add(rs.getNString("z_nummer"));    	
    		rs.close();
    	}catch(Exception e) {
    		System.out.println("Error while selecting z_nummer: ");
    		e.printStackTrace();
    	}
    	return IDs;
    }
	
	ArrayList<Integer> selectCustomersIDFromCustomerTable() {
        ArrayList<Integer> IDs = new ArrayList<>();

        try {
            ResultSet rs = stmt.executeQuery("SELECT kunde.knr FROM kunde ORDER BY knr");
            while (rs.next()) {
                IDs.add(rs.getInt("knr"));
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectCustomersIDFromCustomerTable \nmessage: " + e.getMessage()).trim());
        }
        return IDs;
    }
	
	
	public void close() {
		try {
			stmt.close();
			con.close();
		} catch (Exception ignored) {
		}
	}

	//to store more than one primary key
//	public String[] concatenate(String left, String right) {
//	    String[] newArray = new String[left.length() + 1];
//	    
//	    for(int i = 0; i < left.length(); ++i) {
//	    	newArray[i] += left;
//	    }
//	    newArray[left.length()] = right;
//	    return newArray;
//	}
}