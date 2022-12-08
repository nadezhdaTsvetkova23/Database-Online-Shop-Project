import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;

class HelperCSV {
	//TODO
	public static final String kundeFile = "";
	public static final String unternehmenFile = "";
	public static final String privatkundeFile = "";
	public static final String zahlungFil = "";
	public static final String lieferantFile = "";
	public static final String bestellungFile = "";
	
	public List<String[]> getDataFromCsv(String csv) {	//String csv must be filepath
		
		List<String[]> data = new ArrayList<>();	//each String[] is a row, List is data for whole table
		String line = "";
		
		try {
			BufferedReader br = new BufferedReader(new FileReader(csv));
			
			while((line = br.readLine()) != null) {
				String[] tupel = line.split(",");		//split to get seperate attributes
				data.add(tupel);
			}
			br.close();
		} catch (Exception e) {
			System.out.println("Getting Data from Csv (ERROR): ");
			e.printStackTrace();
		}
		
		return data;
	}
	
	
}
