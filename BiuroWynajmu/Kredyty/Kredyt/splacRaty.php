<?php 

	require('../../config.php');
	$conn = new mysqli($host, $user, $password, $database);

	session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../Logowanie');
 
		 exit();
 
	 }

	 $idKredytu = $_POST['ID_Kredytu'];
	 $iloscRatKtoreCheszSplacic = $_POST['Ile_Chcesz_Splacic_Rat'];

	$zapytanieNr1 = "SELECT * FROM kredyty
		WHERE ID_Kredytu = ".$idKredytu."
		AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

	$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);



	 if($wynikZapytaniaNr1->num_rows == 1){
		$row = $wynikZapytaniaNr1->fetch_object();
		if($row->Ilosc_Rat_Do_Splacenia - $row->Ile_Splaconych_Rat >= $iloscRatKtoreCheszSplacic){
			$kwotaDoZaplatyRat = $iloscRatKtoreCheszSplacic * $row -> Rata_Kredytu;
			
			$zapytanieNr2 = "SELECT * FROM uzytkownicy WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
			$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
			$row2 = $wynikZapytaniaNr2->fetch_object();

			if($kwotaDoZaplatyRat <= $row2 -> Stan_Konta){
				$stanKontaPoOperacji = $row2 -> Stan_Konta -$kwotaDoZaplatyRat;
				$zapytanieNr3 = "UPDATE uzytkownicy SET Stan_Konta=".$stanKontaPoOperacji."  WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
				if($wynikZapytaniaNr3 = $conn->query($zapytanieNr3)){
					$zapytanieNr4 = "INSERT INTO tranzakcje (ID_Uzytkownika, Tytul_Tranzakcji, Opis_Tranzakcji, Stan_Kont_Po_Tranzakcji, Kwota_Tranzakcji) 
						VALUES (".$_SESSION['ID_Uzytkownika'].", 'Spłata kredytu', 'Ilość zapłaconych rat: ".$iloscRatKtoreCheszSplacic."', ".$stanKontaPoOperacji.", -".$kwotaDoZaplatyRat.")";

					echo $zapytanieNr4;

					if($wynikZapytaniaNr4 = $conn->query($zapytanieNr4)){
						$zapytanieNr5 = "UPDATE kredyty SET Ile_Splaconych_Rat=".$row -> Ile_Splaconych_Rat + $iloscRatKtoreCheszSplacic."  
							WHERE ID_Kredytu = ".$idKredytu."
							AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
						if($wynikZapytaniaNr5 = $conn->query($zapytanieNr5)){
							$zapytanieNr6 = "SELECT * FROM kredyty
								WHERE ID_Kredytu = ".$idKredytu."
								AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

							$wynikZapytaniaNr6 = $conn->query($zapytanieNr6);

							$row6 = $wynikZapytaniaNr6->fetch_object();

							if($row6->Ilosc_Rat_Do_Splacenia == $row6->Ile_Splaconych_Rat){
								$zapytanieNr7 = "UPDATE kredyty SET Czy_Kredyt_Splacony = true, Data_Splacenia_Kredytu = NOW()
									WHERE ID_Kredytu = ".$idKredytu."
									AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
								if($wynikZapytaniaNr7 = $conn->query($zapytanieNr7)){
									echo "ja gud";
								}
							}
						}
					}
				}
			}
		}
	 }
	 $zapytanieNr6 = "SELECT * FROM kredyty
		WHERE ID_Kredytu = ".$idKredytu."
		AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

	$wynikZapytaniaNr6 = $conn->query($zapytanieNr6);

	$row6 = $wynikZapytaniaNr6->fetch_object();

	if($row6->Ilosc_Rat_Do_Splacenia == $row6->Ile_Splaconych_Rat && $row6->Czy_Kredyt_Splacony == false){
		$zapytanieNr7 = "UPDATE kredyty SET Czy_Kredyt_Splacony = true, Data_Splacenia_Kredytu = NOW()
			WHERE ID_Kredytu = ".$idKredytu."
			AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

		if($wynikZapytaniaNr7 = $conn->query($zapytanieNr7)){
			echo "ja gud";
		}
	}

	header('Location: index.php?ID_Kredytu='.$_POST['ID_Kredytu'].'');

?>