import java.io.BufferedReader;
import java.io.FileReader;
import java.sql.Date;
//import java.util.concurrent.ThreadLocalRandom;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Random;

public class RandomHelper {
	
	private static HelperCSV helpercsv = new HelperCSV();
	private Random rnd = new Random();
	private Random rand;
	private final char[] alphabet = getCharSet();
	private ArrayList<String> domains;
	private static final String domainsFile = "C:\\Users\\User\\MyJavaProjects\\DBS2022_UniVie_OnlineShop\\src\\input\\domains.csv";
	
	//instantiate the Random object and store data from files in lists
    RandomHelper() {
        this.rand = new Random();
        this.domains = readFile(domainsFile);
    }
//	Integer UniqueRandomKnr() {
//		ArrayList<Integer> pk_knr = new ArrayList<>();
//		knr
//		for(int i = 0; i < 4000; i++) {
//			randomInt()
//		}
//		
//		return 
//	}
	
	Integer randomInt(int min, int max) {
		return rnd.nextInt((max-min)+1) + min;
	}	
	
	Double randomDouble(double min, double max) {
		return min + ( max-min)* rnd.nextDouble();
	}
	
	public String getRandomString(int minLen, int maxLen) {
        StringBuilder out = new StringBuilder();
        
        int len = rand.nextInt((maxLen - minLen) + 1) + minLen;
        while (out.length() < len) {
            int idx = Math.abs((rand.nextInt() % alphabet.length));
            out.append(alphabet[idx]);
        }
        return out.toString();
    }
	
	//returns eMail domain for the mail generator
    private String getRandomDomain() {
    	return domains.get(randomInt(0, domains.size() -1));
    }
	
	public String getRandomMail() {
    	return getRandomString(1,25)+"@"+getRandomDomain();
    }
	
	public static Date randomDate() {
		int startYear=2020;
		int endYear=2022;
		int year = (int)(Math.random()*(endYear-startYear+1))+startYear;	//Random year
		int month= (int)(Math.random()*12)+1;								//Random Month
		Calendar c = Calendar.getInstance();				//Create Calendar objects
		c.set(year, month, 0);								//Setting Date
		int dayOfMonth = c.get(Calendar.DAY_OF_MONTH);		//How many days to get the corresponding year and month
		int day=(int)(Math.random()*dayOfMonth+1)	;		//Generating random days
		Date my_date=Date.valueOf(year+"-"+month+"-"+day);	//Generating Date Object by valueOf Method
		return my_date;
	}
	
	
	//reads single-column files and stores its values as Strings in an ArrayList
	 private ArrayList<String> readFile(String filename) {
	        String line;
	        ArrayList<String> set = new ArrayList<>();
	        try (BufferedReader br = new BufferedReader(new FileReader(filename))) {
	            while ((line = br.readLine()) != null) {
	                try {
	                    set.add(line);
	                } catch (Exception ignored) {
	                }
	            }

	        } catch (Exception e) {
	            e.printStackTrace();
	        }
	        return set;
	    }
	 
	 private char[] getCharSet() { // create getCharSet char array
	        StringBuffer b = new StringBuffer(128);
	        for (int i = 48; i <= 57; i++) b.append((char) i);        // 0-9
	        for (int i = 65; i <= 90; i++) b.append((char) i);        // A-Z
	        for (int i = 97; i <= 122; i++) b.append((char) i);       // a-z
	        return b.toString().toCharArray();
	    }

}
