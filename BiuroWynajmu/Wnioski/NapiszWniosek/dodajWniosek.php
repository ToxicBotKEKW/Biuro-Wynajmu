<?php

	session_start();

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }
	 
	require('../../config.php');

	$conn = new mysqli($host, $user, $password, $database);


	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	function policzRozniceDni($dataPoczatkowa, $dataKoncowa) {
		// Przekształć daty na obiekty DateTime
		$dataPoczatkowa = new DateTime($dataPoczatkowa);
		$dataKoncowa = new DateTime($dataKoncowa);

		// Oblicz różnicę między datami
		$roznica = $dataPoczatkowa->diff($dataKoncowa);

		// Zwróć liczbę dni
		return $roznica->days+1;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$typWniosku = $_POST['typ_wniosku'];

		switch ($typWniosku) {
			case "Wynajem":
				$idTypWniosku = 1;
				break;
			case "Kredyt":
				$idTypWniosku = 2;
				break;
		}




			switch ($typWniosku) {
				case "Wynajem":
					$dzis = new DateTime();

					$dataPoczatkowaWynajmu = $_POST['data_poczatkowa_wynajmu'];
					$dataKoncowaWynajmu = $_POST['data_koncowa_wynajmu'];

					$dzis->add(new DateInterval('P7D'));


					if(new DateTime($dataPoczatkowaWynajmu) > $dzis){

						$overlapCheckQuery = "SELECT * FROM wynajem 
						INNER JOIN wnioski ON wnioski.ID_Wniosku = wynajem.ID_Wniosku 
						WHERE ID_Lokalu = ".$_POST['ID_Lokalu']."
							AND ID_Status_Wniosku = 2
							AND (
								('$dataPoczatkowaWynajmu' BETWEEN Data_Poczatkowa_Wynajmu AND Data_Koncowa_Wynajmu) 
								OR ('$$dataKoncowaWynajmu' BETWEEN Data_Poczatkowa_Wynajmu AND Data_Koncowa_Wynajmu) 
							)";


						$result = $conn->query($overlapCheckQuery);

						if ($result->num_rows > 0) {
							echo "Wybiersz inna datę!";
						} else {


							$zapytanieNr3 = "SELECT * FROM lokale 
								WHERE ID_Lokalu = ".$_POST['ID_Lokalu']."";
							$wynikZapytaniaNr3 = $conn -> query($zapytanieNr3);
							$row3 = $wynikZapytaniaNr3->fetch_object();

							$ileDni = policzRozniceDni($_POST['data_poczatkowa_wynajmu'], $_POST['data_koncowa_wynajmu']);

							$ileDoZaplaty = $ileDni * $row3->Kwota_Czynszu_Za_Dzien;


							$wstawWnioski = "INSERT INTO wnioski (ID_Uzytkownika, ID_Rodzaj_Wniosku, Data_Wniosku, ID_Status_Wniosku) 
							VALUES (".$_SESSION['ID_Uzytkownika'].", ".$idTypWniosku.", NOW(), 1)";
			
							if ($conn->query($wstawWnioski) === TRUE) {
								$lastInsertedId = $conn->insert_id;

								$wstawWynajem = "INSERT INTO wynajem (ID_Uzytkownika, ID_Lokalu, ID_Wniosku, Data_Poczatkowa_Wynajmu, Data_Koncowa_Wynajmu, Ilosc_Dni_Wynajmu, Koszt_Wynajmu) 
													VALUES (".$_SESSION['ID_Uzytkownika'].", ".$_POST['ID_Lokalu'].", $lastInsertedId, '$dataPoczatkowaWynajmu', '$dataKoncowaWynajmu' ,$ileDni , $ileDoZaplaty)";
								$conn->query($wstawWynajem);
								echo "OK";
							}

						}
					}
					else{
						echo '<p>Uwaga! Jeżeli chcesz wynająć jakiś lokal, wniosek musi być złożony najpóźniej 7 dni przed planowanym okresem wynajmu!</p>';
					}
					break;
				
				case "Kredyt":

					$zapytanieNr2 = "SELECT * FROM uzytkownicy 
						WHERE ID_Uzytkownika =".$_SESSION['ID_Uzytkownika']."";		
					$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
					$row2 = $wynikZapytaniaNr2->fetch_object();		

					if($ratatKredytu < $row2->Aktualne_Zarobki){	

						$wstawWnioski = "INSERT INTO wnioski (ID_Uzytkownika, ID_Rodzaj_Wniosku, Data_Wniosku, ID_Status_Wniosku) 
							VALUES (".$_SESSION['ID_Uzytkownika'].", ".$idTypWniosku.", NOW(), 1)";

						if ($conn->query($wstawWnioski) === TRUE) {

							$kwotaDoSplacenia = $_POST['kwota_kredytu'] * 1.1;
							$ratatKredytu = $kwotaDoSplacenia / $_POST['ile_rat'];

							$lastInsertedId = $conn->insert_id;
							$wstawKredyt = "INSERT INTO kredyty (ID_Uzytkownika, ID_Wniosku, Kwota_Kredytu, Do_Splacenia, Rata_Kredytu, Ilosc_Rat_Do_Splacenia, Ile_Splaconych_Rat, Data_Wziecia_Kredytu, Czy_Kredyt_Splacony) 
											VALUES (".$_SESSION['ID_Uzytkownika'].", $lastInsertedId, ".$_POST['kwota_kredytu'].", $kwotaDoSplacenia, $ratatKredytu, ".$_POST['ile_rat'].", 0, NOW(), 0)";
							$conn->query($wstawKredyt);
						}
					}
					else{
						echo '<p>Niestać cię na spłatę raty!</p>';
					}
					break;

				default:
					break;
			}

		} else {
			echo "Error: " . $wstawWnioski . "<br>" . $conn->error;
		}

	header('Location: ../../');

	$conn->close();
?>