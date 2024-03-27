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

	if(!isset($_GET['ID_Lokalu'])){
		header('Location: ../');
	}
	 
	require('../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>
		<div class="navbar">
			<a href="../../">Strona Główna</a>
			<a href="../">Lokale</a>
			<?php 
				if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
					echo '<a href="../../Wnioski">Wnioski</a>';
				}
			?>
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

			$ID_Lokalu = $_GET['ID_Lokalu'];

			$zapytanieNr1 = "SELECT * FROM lokale 
				INNER JOIN dostepnosc_lokalu ON lokale.ID_Dostepnosci = dostepnosc_lokalu.ID_Dostepnosci 
				INNER JOIN adresy ON adresy.ID_Adres = lokale.ID_Adres
				WHERE Nazwa_Dostepnosci = 'Dostępny' AND ID_Lokalu = $ID_Lokalu";

			$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);

			if ($wynikZapytaniaNr1->num_rows == 1) {
				$row = $wynikZapytaniaNr1->fetch_object();
				echo '<div class="daneLokalu">';
					echo '<h1>' . $row->Nazwa_Lokalu . '</h1>';
					echo '<img src="../../obrazki/Lokale/' . $row->Zdjecie_Lokalu . '">';
					echo '<h2>Opis:</h2><p>' . $row->Opis_Lokalu . '</p>';
					echo '<h2>Dane:</h2><p>Powierzchnia: ' . $row->Powierzchnia . '</p>';
					echo '<p>Czynsz (za dzień!): ' . $row->Kwota_Czynszu_Za_Dzien . ' PLN</p>';
					
					echo '<h2>Adres:</h2>';
						echo '<p>Kod Pocztowy: ' . $row->Kod_Pocztowy . '</p>';
						echo '<p>Miejscowość: ' . $row->Miasto . '</p>';
						echo '<p>Ulica: ' . $row->Ulica . '</p>';
						echo '<p>Numer Budynku: ' . $row->Numer_Budynku . '</p>';
						echo '<p>Numer_Lokalu: ' . $row->Numer_Lokalu . '</p>';

					echo '<h2>Zajęte terminy:</h2>';
					echo '<div id="zajeteTerminy">';



						$zajeteDaty = []; // Tablica do przechowywania zajętych dat

						$zapytanieNr2 = "SELECT * FROM lokale 
											INNER JOIN wynajem ON wynajem.ID_Lokalu = lokale.ID_Lokalu
											INNER JOIN wnioski ON wnioski.ID_Wniosku = wynajem.ID_Wniosku
											WHERE ID_Status_Wniosku = 2 AND lokale.ID_Lokalu = $ID_Lokalu";
						
						$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);
						
						while ($row2 = $wynikZapytaniaNr2->fetch_object()) {
							// Wyciąganie i przechowywanie zajętych dat
							$dataPoczatkowa = new DateTime($row2->Data_Poczatkowa_Wynajmu);
							$dataKoncowa = new DateTime($row2->Data_Koncowa_Wynajmu);
							
							while ($dataPoczatkowa <= $dataKoncowa) {
								$zajeteDaty[] = $dataPoczatkowa->format('Y-m-d');
								$dataPoczatkowa->modify('+1 day');
							}
						}
						
						// Ładniejsze wypisywanie zajętych dat
						if (!empty($zajeteDaty)) {
							foreach($zajeteDaty as $data){
								echo '<p>Zajęta data: ';
								
								echo $data;
								
								echo '</p>';
							}
						} else {
							echo '<p>Brak zajętych dat.</p>';
						}




					echo '</div>';

					if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
						echo '<div id="odnosniki">';
							echo '<a href="../../Wnioski/NapiszWniosek?typ_wniosku=Wynajem&ID_Lokalu=' . $ID_Lokalu . '">
								Wynajmij Lokal
							</a>';
							echo '<a href="../../ZgloszeniaSerwisowe/NapiszZgloszenie?ID_Lokalu=' . $ID_Lokalu . '">
								Napisz Zgłoszenie
							</a>';
						echo '</div>';
					}


				echo '</div>';
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