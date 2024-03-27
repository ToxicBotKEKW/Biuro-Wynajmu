<?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		header('Location: ../../../');

 
		 exit();
 
	 }

	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);

	$rolaNaKtoraZamieniamy = $_POST['rola'];
	 
	$zapytanieNr1 = "SELECT * FROM uzytkownicy 
		INNER JOIN adresy ON uzytkownicy.ID_Adres_Zamieszkania = adresy.ID_Adres 
		INNER JOIN rola ON uzytkownicy.ID_Roli = rola.ID_Roli
		WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

	$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

	if($wynikZapytaniaNr1 -> num_rows == 1){
		$row1 = $wynikZapytaniaNr1 -> fetch_object();

		if($row1->Nazwa_Roli == "Administrator"){
			switch($rolaNaKtoraZamieniamy){
				case 'Uzytkownik':
					$zapytanieNr2 = "UPDATE uzytkownicy
						SET ID_Roli = 2 
						WHERE ID_Uzytkownika = ".$_POST['ID_Uzytkownika']."";

					$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);
					break;
				case 'Pracownik':
					$zapytanieNr2 = "UPDATE uzytkownicy
						SET ID_Roli = 3 
						WHERE ID_Uzytkownika = ".$_POST['ID_Uzytkownika']."";

					$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);
					break;
			}
		}
	}

	header('Location: ./index.php?ID_Uzytkownika='.$_POST['ID_Uzytkownika'].'');

	$conn->close();
?>
