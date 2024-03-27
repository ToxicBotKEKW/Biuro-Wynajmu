<?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		 header('Location: ../../../');
 
		 exit();
 
	 }

	 if(!isset($_POST['ID_Wniosku'])){
		header('Location: ../../../');
 
		exit();
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	$zapytanieNr1 = "SELECT * FROM wnioski
		INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
		INNER JOIN rodzaj_wniosku ON rodzaj_wniosku.ID_Rodzaj_Wniosku = wnioski.ID_Rodzaj_Wniosku
		WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."
		AND Nazwa_Statusu = 'Oczekuje'
	";

	$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

	if($wynikZapytaniaNr1 -> num_rows == 1){
		$row = $wynikZapytaniaNr1 -> fetch_object();

		switch($row->Nazwa_Rodzaju_Wniosku){
			case 'Wynajem mieszkania':
				$zapytanieNr3 = "SELECT * FROM wynajem
					WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
				$wynikZapytaniaNr3 = $conn -> query($zapytanieNr3);
				$row2 = $wynikZapytaniaNr3->fetch_object();

					$dzis = new DateTime();

					$dataPoczatkowaWynajmu = $row2->Data_Poczatkowa_Wynajmu;
					$dataKoncowaWynajmu = $row2->Data_Koncowa_Wynajmu;

					$dzis->add(new DateInterval('P7D'));


					if(new DateTime($dataPoczatkowaWynajmu) > $dzis){

						$overlapCheckQuery = "SELECT * FROM wynajem 
						INNER JOIN wnioski ON wnioski.ID_Wniosku = wynajem.ID_Wniosku 
						WHERE ID_Lokalu = ".$row2->ID_Lokalu."
							AND ID_Status_Wniosku = 2
							AND (
								('$dataPoczatkowaWynajmu' BETWEEN Data_Poczatkowa_Wynajmu AND Data_Koncowa_Wynajmu) 
								OR ('$$dataKoncowaWynajmu' BETWEEN Data_Poczatkowa_Wynajmu AND Data_Koncowa_Wynajmu) 
							)";


						$result = $conn->query($overlapCheckQuery);

						$row5 = $result -> fetch_object();

						if ($result->num_rows > 0) {
							
								$zapytanieNr2 = "UPDATE wnioski 
									SET ID_Status_Wniosku = 3 
									WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

								if($wynikZapytaniaNr2){
									echo 'okaa';
								}
							
						} else {

							$zapytanieNr6 = "SELECT * FROM uzytkownicy
								WHERE ID_Uzytkownika = ".$row->ID_Uzytkownika."";
							$wynikZapytaniaNr6 = $conn -> query($zapytanieNr6);

							$row6 = $wynikZapytaniaNr6 -> fetch_object();

							if($row2 -> Koszt_Wynajmu < $row6 -> Stan_Konta){

								$aktualneSrodki = $row6->Stan_Konta;
								$srodkiDoOdjecia = $row2->Koszt_Wynajmu;

								$srodkiDoWstawienia = $aktualneSrodki - $srodkiDoOdjecia;

								$zapytanieNr7 = "UPDATE uzytkownicy SET Stan_Konta = '" . $srodkiDoWstawienia . "' WHERE ID_Uzytkownika = " .$row->ID_Uzytkownika;
								$wykoanieniZapytanieNr7 = $conn->query($zapytanieNr7);

								$zapytanieNr8 = "INSERT INTO tranzakcje (ID_Uzytkownika, Tytul_Tranzakcji, Opis_Tranzakcji, Stan_Kont_Po_Tranzakcji, Kwota_Tranzakcji) 
									VALUES ('".$row->ID_Uzytkownika."', 'Opłacenie Lokalu', 'Opłacenie Lokalu', '".$srodkiDoWstawienia."', -'".$srodkiDoOdjecia."')";

								$wykoanieniZapytanieNr8 = $conn->query($zapytanieNr8);


								$zapytanieNr4 = "UPDATE wnioski 
									SET ID_Status_Wniosku = 2 WHERE 
									ID_Wniosku = ".$_POST['ID_Wniosku']."";
								$wynikZapytaniaNr4 = $conn -> query($zapytanieNr4);

								if($wynikZapytaniaNr4){
									echo 'ok2';
								}
							}

						}
					}
					else{

						$zapytanieNr2 = "UPDATE wnioski 
							SET ID_Status_Wniosku = 3 
							WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
						$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

						if($wynikZapytaniaNr2){
							echo 'ok2';
						}
					}
				

				break;
			case 'Kredyt hipoteczny':

				$zapytanieNr3 = "SELECT * FROM kredyty
					WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
				$wynikZapytaniaNr3 = $conn -> query($zapytanieNr3);
				$row2 = $wynikZapytaniaNr3->fetch_object();

					$zapytanieNr5 = "SELECT * FROM uzytkownicy 
						WHERE ID_Uzytkownika =".$row->ID_Uzytkownika."";		
					$wynikZapytaniaNr5 = $conn->query($zapytanieNr5);
					$row3 = $wynikZapytaniaNr5->fetch_object();		

					if($row2->Rata_Kredytu < $row3->Aktualne_Zarobki){	

						$aktualneSrodki = $row->Stan_Konta;
						$srodkiDoDodania = $row2->Kwota_Kredytu;

						$srodkiDoWstawienia = $aktualneSrodki + $srodkiDoDodania;

						$zapytanieNr3 = "UPDATE uzytkownicy SET Stan_Konta = '" . $srodkiDoWstawienia . "' WHERE ID_Uzytkownika = " . $row->ID_Uzytkownika;
						$wykoanieniZapytanieNr3 = $conn->query($zapytanieNr3);

						$zapytanieNr4 = "INSERT INTO tranzakcje (ID_Uzytkownika, Tytul_Tranzakcji, Opis_Tranzakcji, Stan_Kont_Po_Tranzakcji, Kwota_Tranzakcji) 
							VALUES ('".$row->ID_Uzytkownika."', 'Kredyt', 'Kredyt', '".$srodkiDoWstawienia."', '".$srodkiDoDodania."')";

						$wykoanieniZapytanieNr4 = $conn->query($zapytanieNr4);

						$zapytanieNr4 = "UPDATE wnioski 
							SET ID_Status_Wniosku = 2 WHERE 
							ID_Wniosku = ".$_POST['ID_Wniosku']."";
						$wynikZapytaniaNr4 = $conn -> query($zapytanieNr4);

						if($wynikZapytaniaNr4){
							echo 'ok';
						}

					}
					else{

						$zapytanieNr2 = "UPDATE wnioski 
							SET ID_Status_Wniosku = 3 
							WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
						$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

						if($wynikZapytaniaNr2){
							echo 'ok2';
						}
					}

				break;
		}

	}

	header('Location: index.php?ID_Wniosku='.$_POST['ID_Wniosku'].'');

	$conn->close();
?>
