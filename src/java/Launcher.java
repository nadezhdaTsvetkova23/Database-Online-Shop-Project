import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.sql.*;
import java.text.DecimalFormat;
import java.time.Duration;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.List;
import java.util.Set;
import java.util.stream.Stream;

public class Launcher {

	static DatabaseHelper dbhelper = new DatabaseHelper();
	static HelperCSV helpercsv = new HelperCSV();
	static RandomHelper rh = new RandomHelper();
	
	
	public static void main(String args[]) {

		dbhelper.deleteAllEntries(); // clear database to prevent unique constraint violations
		System.out.println("All entries from tables deleted.");

//primary keys of tables get stored in <x>Keys list to dynamically determine foreign keys for relations	
//if primary key is stored inside csv, directly add to list (no query to database needed)
//if primary key is created by database (trigger/generated as identity), query the db

//INSERT KUNDE

		List<String[]> kundeInput = helpercsv
				.getDataFromCsv("C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\kunde.csv"); // TODO
																														// relative
																														// path
		List<String> kundeKeys = new ArrayList<>();
		int count1 = 0;
		for (String[] tupel : kundeInput) {
			Integer knr = rh.randomInt(100000000, 999999999); // knr is integer with 9 digits
			String email = rh.getRandomMail();
			dbhelper.insertCustomer(knr.toString(), tupel[0], email, tupel[1], tupel[2]); // knr and email need to be
																							// unique
			kundeKeys.add(knr.toString()); // knr
			System.out.println(++count1 + " inserted into kunde table");
		}

//INSERT UNTERNEHMEN

		List<String[]> unternehmenInput = helpercsv.getDataFromCsv(
				"C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\unternehmen.csv"); // TODO
																											// relative
																											// path
		List<String> unternehmenKeys = new ArrayList<>();
		List<String> unternehmen_fk = new ArrayList<>();
		
		List<String> kundeKeys_copy = new ArrayList<>();
		kundeKeys_copy.addAll(kundeKeys);
		
		int count2 = 0;
		for (String[] tupel : unternehmenInput) {
			
			String foreignKey_untr = kundeKeys_copy.get(rh.randomInt(0, kundeKeys_copy.size() - 1));
			kundeKeys_copy.remove(foreignKey_untr);
			unternehmen_fk.add(foreignKey_untr);
			
			// String unternehmen_id = rh.getRandomString(7, 8);
			dbhelper.insertCompany(tupel[0], foreignKey_untr, tupel[1]);
			unternehmenKeys.add(tupel[0]); // unternehmen_id
			System.out.println(++count2 + " inserted into unternehmen table");
		}

//INSERT PRIVATKUNDE

		List<String[]> privatkundeInput = helpercsv.getDataFromCsv(
				"C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\privatkunde.csv"); // TODO
																											// relative
																											// path
		List<String> privatkundeKeys = new ArrayList<>();
		List<String> privatkunde_fk = new ArrayList<>();
		
		int count3 = 0;
		for (String[] tupel : privatkundeInput) {
			
			String foreignKey_pk = kundeKeys_copy.get(rh.randomInt(0, kundeKeys_copy.size()-1));
			kundeKeys_copy.remove(foreignKey_pk);
			
			privatkunde_fk.add(foreignKey_pk);
			dbhelper.insertPrivateCustomer(tupel[0], foreignKey_pk, tupel[1]);
			privatkundeKeys.add(tupel[0]);
			System.out.println(++count3 + " inserted into privatkunde table");
		}


//INSERT ZAHLUNG

		List<String[]> paymentInput = helpercsv
				.getDataFromCsv("C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\zahlung.csv");
		
		List<String> paymentKeys = new ArrayList<>(); //inserted with trigger
		List<String> payment_fk = new ArrayList<>();
		kundeKeys_copy.clear();
		kundeKeys_copy.addAll(kundeKeys);
		
		int count4 = 0;
		for (String[] tupel : paymentInput) {
			
			String foreignKey_z = kundeKeys_copy.get(rh.randomInt(0, kundeKeys_copy.size() - 1));
			kundeKeys_copy.remove(foreignKey_z);
			
			payment_fk.add(foreignKey_z);
			dbhelper.insertPayment(foreignKey_z, tupel[0], tupel[1]);
			System.out.println(++count4 + " inserted into zahlung table");
		}

		paymentKeys = dbhelper.selectIdFromPayment(); // z_nummer

//INSERT LIEFERANT

		List<String[]> lieferantInput = helpercsv.getDataFromCsv(
				"C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\lieferant.csv");
		List<String> lieferantKeys = new ArrayList<>();
		int count5 = 0;
		for (String[] tupel : lieferantInput) {
			Integer l_id = rh.randomInt(1000000, 9999999);
			lieferantKeys.add(l_id.toString());
			
			dbhelper.insertLieferant(l_id.toString(), tupel[1], tupel[2]);
			
			System.out.println(++count5 + " inserted into lieferant table");
		}

//INSERT BESTELLUNG

		List<String[]> orderInput = helpercsv.getDataFromCsv(
				"C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\bestellung.csv");
		
		List<String> orderKeys = new ArrayList<>();
		List<String> order_fk1 = new ArrayList<>();
		List<String> order_fk2 = new ArrayList<>();
		
		kundeKeys_copy.clear();
		kundeKeys_copy.addAll(kundeKeys);
		
		int count6 = 0;
		for (String[] tupel : orderInput) {
			
			Integer b_nummer = rh.randomInt(100000, 999999999);
			
			String foreignKey1 = lieferantKeys.get(rh.randomInt(0, lieferantKeys.size() - 1)); //l_id
			order_fk1.add(foreignKey1);
			
			String foreignKey2 = kundeKeys_copy.get(rh.randomInt(0, kundeKeys_copy.size() - 1)); //knr
			kundeKeys_copy.remove(foreignKey2);
			
			order_fk2.add(foreignKey2);
			
			dbhelper.insertOrder(b_nummer.toString(), foreignKey1, foreignKey2, rh.randomInt(0, 50).toString(), rh.randomDouble(0, 1199.9).toString(), tupel[1],
					RandomHelper.randomDate().toString());
			orderKeys.add(b_nummer.toString());
			System.out.println(++count6 + " inserted into bestellung table");
		}

////INSERT LEITET
//		
//		List<String[]> leitetKeys = new ArrayList<>();
//		String foreignKey1 = lieferantKeys.get(rh.randomInt(0, lieferantKeys.size()-1));
//		String foreignKey2 = lieferantKeys.get(rh.randomInt(0, lieferantKeys.size()-1));
//		if(foreignKey1 == foreignKey2) {
//			while(foreignKey1 == foreignKey2)
//				foreignKey2 = lieferantKeys.get(rh.randomInt(0, lieferantKeys.size()-1));
//		}
//		leitetKeys.add(dbhelper.concatenate(foreignKey1, foreignKey2));
//		

		dbhelper.countAlltables();
		dbhelper.close();

	}
}
