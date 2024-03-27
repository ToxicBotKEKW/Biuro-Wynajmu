<?php 

	require('../../../config.php');
	session_start();

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../Logowanie');
 
		 exit();
 
	 }

	if(!isset($czyWykonene)){
		if(isset($_POST['formIloscSrodkow'])){

			$conn = new mysqli($host, $user, $password, $database);
			$zapytanieNr1 = "SELECT * FROM uzytkownicy WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
			$wykoanieniZapytanieNr1 = $conn->query($zapytanieNr1);

			if($wykoanieniZapytanieNr1 -> num_rows == 1){
				$row = $wykoanieniZapytanieNr1->fetch_object();
				$aktualneSrodki = $row->Stan_Konta;
				$srodkiDoDodania = $_POST["formIloscSrodkow"];

				$srodkiDoWstawienia = $aktualneSrodki + $srodkiDoDodania;

				$zapytanieNr2 = "UPDATE uzytkownicy SET Stan_Konta = '" . $srodkiDoWstawienia . "' WHERE ID_Uzytkownika = " . $_SESSION['ID_Uzytkownika'];
				$wykoanieniZapytanieNr2 = $conn->query($zapytanieNr2);

				$zapytanieNr3 = "INSERT INTO tranzakcje (ID_Uzytkownika, Tytul_Tranzakcji, Opis_Tranzakcji, Stan_Kont_Po_Tranzakcji, Kwota_Tranzakcji) 
					VALUES ('".$_SESSION['ID_Uzytkownika']."', 'Doładowanie Konta', 'Doładowanie Konta', '".$srodkiDoWstawienia."', '".$srodkiDoDodania."')";

				$wykoanieniZapytanieNr3 = $conn->query($zapytanieNr3);
			}

		}
	}

	$czyWykonene = true;

	header('Location: ../')


?>