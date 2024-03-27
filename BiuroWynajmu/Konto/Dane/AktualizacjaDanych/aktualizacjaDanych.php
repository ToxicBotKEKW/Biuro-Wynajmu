 <?php 
	 
	session_start();

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	{
 
		 header('Location: ../../Logowanie');
 
		exit();
 
	}
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$imie = mysqli_real_escape_string($conn, $_POST['imie']);
		$nazwisko = mysqli_real_escape_string($conn, $_POST['nazwisko']);
		$data_urodzenia = mysqli_real_escape_string($conn, $_POST['data_urodzenia']);
		$kod_pocztowy = mysqli_real_escape_string($conn, $_POST['kod_pocztowy']);
		$miasto = mysqli_real_escape_string($conn, $_POST['miasto']);
		$ulica = mysqli_real_escape_string($conn, $_POST['ulica']);
		$numer_budynku = mysqli_real_escape_string($conn, $_POST['numer_budynku']);
		$numer_lokalu = mysqli_real_escape_string($conn, $_POST['numer_lokalu']);
		$aktualne_zarobki = mysqli_real_escape_string($conn, $_POST['aktualne_zarobki']);
	
		$zapytanieNr1 = "UPDATE uzytkownicy 
						SET Imie = '$imie', 
							Nazwisko = '$nazwisko', 
							Data_Urodzenia = '$data_urodzenia', 
							Aktualne_Zarobki = '$aktualne_zarobki' 
						WHERE ID_Uzytkownika = " . $_SESSION['ID_Uzytkownika'];
	
		$zapytanieNr2 = "UPDATE adresy 
							   SET Kod_Pocztowy = '$kod_pocztowy', 
								   Miasto = '$miasto', 
								   Ulica = '$ulica', 
								   Numer_Budynku = '$numer_budynku', 
								   Numer_Lokalu = '$numer_lokalu' 
							   WHERE ID_Adres = (SELECT ID_Adres_Zamieszkania FROM uzytkownicy WHERE ID_Uzytkownika = " . $_SESSION['ID_Uzytkownika'] .")";
	
		$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);
		$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
	
		if ($wynikZapytaniaNr1 && $wynikZapytaniaNr2) {
			echo "Dane zostały zaktualizowane pomyślnie.";
		} else {
			echo "Błąd podczas aktualizacji danych: " . $conn->error;
		}
	} else {
		
	}
	
	$conn->close();

	header("Location: ../"); 
	exit();
	 
?>

