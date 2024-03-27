<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="style/style.css"/>
	 <title>Biuro Wynajmu</title>
	 <link rel="icon" href="../../obrazki/ikonka.png" type="image/icon type">
	 
	 <?php 
	 
	session_start();

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) || !isset($_POST['typ_wniosku']))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }
	 
	require('../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>
		<div class="navbar">
			<a href="../../">Strona Główna</a>
			<a href="../../Lokale">Lokale</a>
			<div class="dropdown">

				<?php 
					if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
						echo '
						
						<button class="dropbtn">'.$_SESSION['Imie'].' '.$_SESSION['Nazwisko'].'</button>
							<div class="dropdown-content">
								<a href="../../Konto/Dane/">Dane Konta</a>
								<a href="../../Konto/WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="../../Konto/MojeWnioski/">Moje Wnioski</a>
								<a href="../../Konto/MojeKredyty/">Moje Kredyty</a>
								<a href="../../Konto/MojeTranzakcje/">Moje Tranzakcje</a>
								<a href="../../Konto/Wyloguj/logout.php">Wyloguj Się</a>
							</div>
						
						';
					}
					else{
						echo '<a href="../../Konto/Logowanie/">Zaloguj się</a>';
					}
				?>
			</div> 
		</div>
    </header>
	
	<section>

		<article>

			<?php

				function policzRozniceDni($dataPoczatkowa, $dataKoncowa) {
					// Przekształć daty na obiekty DateTime
					$dataPoczatkowa = new DateTime($dataPoczatkowa);
					$dataKoncowa = new DateTime($dataKoncowa);

					// Oblicz różnicę między datami
					$roznica = $dataPoczatkowa->diff($dataKoncowa);

					// Zwróć liczbę dni
					return $roznica->days+1;
				}


				if ($_POST['typ_wniosku'] == "Wynajem" && isset($_POST['ID_Lokalu'])) {

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
							echo "<p>Wybierz inny termin!</p>";
						}
						else{

							$zapytanieNr1 = "SELECT * FROM lokale 
								WHERE ID_Lokalu = ".$_POST['ID_Lokalu']."";
							$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);
							$row = $wynikZapytaniaNr1->fetch_object();

							$ileDni = policzRozniceDni($_POST['data_poczatkowa_wynajmu'], $_POST['data_koncowa_wynajmu']);

							$ileDoZaplaty = $ileDni * $row->Kwota_Czynszu_Za_Dzien;

							echo '
								<h1>'.$_POST['typ_wniosku'].'</h1>
								<form action="dodajWniosek.php" method="POST">

									<p>Lokal który chcesz wynająć: <a href="../../Lokale/Lokal/index.php?ID_Lokalu='.$_POST['ID_Lokalu'].'"> '.$_POST['ID_Lokalu'].' </a></p>

									<input type="hidden" value="'.$_POST['typ_wniosku'].'" name="typ_wniosku">
									<input type="hidden" value="'.$_POST['ID_Lokalu'].'" name="ID_Lokalu">

									<label for="data_poczatkowa_wynajmu">Data Początkowa Wynajmu:</label>
									<input type="date" name="data_poczatkowa_wynajmu" value="'.$_POST['data_poczatkowa_wynajmu'].'" readonly>

									<label for="data_poczatkowa_wynajmu">Data Końcowa Wynajmu:</label>
									<input type="date" name="data_koncowa_wynajmu" value="'.$_POST['data_koncowa_wynajmu'].'" readonly>

									<p>Ilość dni wynajmu: '.$ileDni.'</p>

									<p>Całkowita kwota wynajmu: '.$ileDoZaplaty.' PLN</p>';

									$zapytanieNr2 = "SELECT * FROM uzytkownicy 
										WHERE ID_Uzytkownika =".$_SESSION['ID_Uzytkownika']."";		
									$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
									$row2 = $wynikZapytaniaNr2->fetch_object();					

									if($ileDoZaplaty < $row2->Stan_Konta){
										echo '<input type="submit" value="Wyślij wniosek">';
									}
									else {
										echo '<p>Niestać cię na zapłatę czynszu!</p>';
									}

							echo '</form>';
						}
					}
					else{
						echo '<p>Żeby wynająć jakiś lokal musisz złożyć wniosek minimum z 7 dniowym wyprzedzeniem</p>';
					}
						
				} else if ($_POST['typ_wniosku'] == "Kredyt") {

					$kwotaDoSplacenia = $_POST['kwota_kredytu'] * 1.1;
					$ratatKredytu = $kwotaDoSplacenia / $_POST['ile_rat'];

					echo '
						<h1>'.$_POST['typ_wniosku'].'</h1>
						<form action="dodajWniosek.php" method="POST">
							<input type="hidden" value="'.$_POST['typ_wniosku'].'" name="typ_wniosku">

							<label for="kwota_kredytu">Kwota Kredytu:</label>
							<input type="text" name="kwota_kredytu" value="'.$_POST['kwota_kredytu'].'" readonly>

							<label for="ile_rat">Ile rat (min 8 / max 180):</label>
							<input type="number" min="8" max="180" name="ile_rat" value="'.$_POST['ile_rat'].'" readonly>

							<p>Kwota Do Spłacenia: '.$kwotaDoSplacenia.' PLN (+ 10%)</p>

							<p>Rata Kredytu Wynosi: '.$ratatKredytu.' PLN</p>';

							$zapytanieNr2 = "SELECT * FROM uzytkownicy 
								WHERE ID_Uzytkownika =".$_SESSION['ID_Uzytkownika']."";		
							$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
							$row2 = $wynikZapytaniaNr2->fetch_object();		

							if($ratatKredytu < $row2->Aktualne_Zarobki){							
								echo '<input type="submit" value="Wyślij wniosek">';
							}
							else{
								echo '<p>Niestać cię na spłatę raty!</p>';
							}

					echo '</form>';
				} else {
					echo '<h1>Nieprawidłowy typ wniosku!</h1>';
				}

				?>

		</article>
		
	</section>
    
	<footer>
        <?php require("../../stopka.php"); ?>
    </footer>
	
</body>
		<?php
			$conn->close();
		?>
</html>