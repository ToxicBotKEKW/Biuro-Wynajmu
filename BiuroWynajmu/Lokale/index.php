<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="style/style.css"/>
	 <title>Biuro Wynajmu</title>
	 <link rel="icon" href="../obrazki/ikonka.png" type="image/icon type">
	 
	 <?php 
	 
		session_start();
		
		require('../config.php');

		$conn = new mysqli($host, $user, $password, $database);

		if(!isset($_GET['strona'])){
			$_GET['strona'] = 1;
		}
		if(!isset($_GET['Nazwa_Lokalu'])){
			$_GET['Nazwa_Lokalu'] = null;
		}
		if(!isset($_GET['Min_Za_Dzien'])){
			$_GET['Min_Za_Dzien'] = null;
		}
		if(!isset($_GET['Max_Za_Dzien'])){
			$_GET['Max_Za_Dzien'] = null;
		}
	 
	 ?>

</head>
<body>
	<header>
		<div class="navbar">
			<a href="../">Strona Główna</a>
			<a href="">Lokale</a>
			<?php 
				if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
					echo '<a href="../Wnioski/">Wnioski</a>';
				}
			?>
			<div class="dropdown">

				<?php 
					if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
						echo '
						
						<button class="dropbtn">'.$_SESSION['Imie'].' '.$_SESSION['Nazwisko'].'</button>
							<div class="dropdown-content">
								<a href="../Konto/Dane/">Dane Konta</a>
								<a href="../Konto/WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="../Konto/MojeWnioski/">Moje Wnioski</a>
								<a href="../Konto/MojeKredyty/">Moje Kredyty</a>
								<a href="../Konto/MojeTranzakcje/">Moje Tranzakcje</a>
								<a href="../Konto/Wyloguj/logout.php">Wyloguj Się</a>
							</div>
						
						';
					}
					else{
						echo '<a href="../Konto/Logowanie/">Zaloguj się</a>';
					}
				?>
			</div> 
		</div>
    </header>
	
	<section>

		<article>
			
			<h1>Lokale Do Wynajęcia</h1>
			
			<?php 



				if (isset($_GET['strona']) && !empty($_GET['strona'])) {
					if (isset($_GET['Nazwa_Lokalu']) && !empty($_GET['Nazwa_Lokalu'])) {
						if (isset($_GET['Min_Za_Dzien']) && !empty($_GET['Min_Za_Dzien'])) {
							if (isset($_GET['Max_Za_Dzien']) && !empty($_GET['Max_Za_Dzien'])) {

								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien BETWEEN ".$_GET['Min_Za_Dzien']." AND ".$_GET['Max_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien BETWEEN ".$_GET['Min_Za_Dzien']." AND ".$_GET['Max_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);
								
							} else {
								
								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien >= ".$_GET['Min_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien >= ".$_GET['Min_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							}
						} else {
							if (isset($_GET['Max_Za_Dzien']) && !empty($_GET['Max_Za_Dzien'])) {
								
								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien <= ".$_GET['Max_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien <= ".$_GET['Max_Za_Dzien']."
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							} else {
								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Nazwa_Lokalu LIKE '%".$_GET['Nazwa_Lokalu']."%'
									";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							}
						}
					} else {
						if (isset($_GET['Min_Za_Dzien']) && !empty($_GET['Min_Za_Dzien'])) {
							if (isset($_GET['Max_Za_Dzien']) && !empty($_GET['Max_Za_Dzien'])) {

								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien BETWEEN ".$_GET['Min_Za_Dzien']." AND ".$_GET['Max_Za_Dzien']."
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien BETWEEN ".$_GET['Min_Za_Dzien']." AND ".$_GET['Max_Za_Dzien']."";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							} else {

								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien >= ".$_GET['Min_Za_Dzien']."
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien >= ".$_GET['Min_Za_Dzien']."";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							}
						} else {
							if (isset($_GET['Max_Za_Dzien']) && !empty($_GET['Max_Za_Dzien'])) {

								$strona = $_GET['strona'];
								$odIlu = 10 * ($strona - 1);

								$zapytanieNr1 = "SELECT * FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien <= ".$_GET['Max_Za_Dzien']."
									LIMIT 10 OFFSET ".$odIlu."";

								$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

								$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale
									AND Kwota_Czynszu_Za_Dzien <= ".$_GET['Max_Za_Dzien']."";

								$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							} else {

							$strona = $_GET['strona'];
							$odIlu = 10 * ($strona - 1);

							$zapytanieNr1 = "SELECT * FROM dostepne_lokale
								LIMIT 10 OFFSET ".$odIlu."";

							$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

							$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM dostepne_lokale";

							$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);


							}
						}
					}
				} 
				else {

					$zapytanieNr1 = "SELECT * FROM lokale INNER JOIN dostepnosc_lokalu ON lokale.ID_Dostepnosci = dostepnosc_lokalu.ID_Dostepnosci WHERE Nazwa_Dostepnosci = 'Dostępny'";
					$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

					$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM lokale INNER JOIN dostepnosc_lokalu ON lokale.ID_Dostepnosci = dostepnosc_lokalu.ID_Dostepnosci WHERE Nazwa_Dostepnosci = 'Dostępny'";
					$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

				}




					if($wynikZapytaniaNr1 -> num_rows > 0){

						echo '<div id="wyszukiwanie">';

						echo '<form action="" method="GET">';
							echo '<input type="hidden" name="strona" value='.$strona.'>';
							echo '<input type="text" name="Nazwa_Lokalu" placeholder="Nazwa Lokalu">';
							echo '<input type="number" name="Min_Za_Dzien" placeholder="Min kwota za dzień">';
							echo '<input type="number" name="Max_Za_Dzien" placeholder="Max kwota za dzień">';
							echo '<input type="submit" value="Wyszukaj">';
							echo '</form>';
						echo '</div>';


						echo '<div id="lokale">';
							while($row = $wynikZapytaniaNr1 -> fetch_object()){
								echo '<a href="Lokal/index.php?ID_Lokalu='.$row->ID_Lokalu.'">';
									echo '<div class="daneLokalu">';
									
										echo '<div class="daneLokaluLewo">';
											echo '<img src="../obrazki/Lokale/'.$row->Zdjecie_Lokalu.'">';
										echo '</div>';
									
										echo '<div class="daneLokaluPrawo">';
											echo '<div class="nazwaLokalu"><h1>'.$row->Nazwa_Lokalu.'</h1><div class="cenaWynajmuLokalu">'.$row->Kwota_Czynszu_Za_Dzien.' PLN / Dzień</div></div>';
											echo '<p>'.$row->Opis_Lokalu.'</p>';
										echo '</div>';
									
									echo '</div>';
								echo '</a>';
							}

						echo '</div>';

						echo '<div id="stronnicowanie">';

							// Pobranie ilości wyników
							$row2 = $wynikZapytaniaNr2->fetch_object();
							$ileWynikow = $row2->zlicz;
							$ileStron = ceil($ileWynikow / 10);

							// Sprawdzenie ilości stron i utworzenie linków
							if ($ileStron > 1) {
								// Warunki dla małej liczby stron
								if ($ileStron < 5) {
									for ($i = 1; $i <= $ileStron; $i++) {
										echo '<a href="index.php?strona=' . $i . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . $i . '</a>';
									}
								} else {
									// Warunki dla większej liczby stron
									if ($_GET['strona'] <= 2) {
										for ($i = 1; $i <= 4; $i++) {
											echo '<a href="index.php?strona=' . $i . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . $i . '</a>';
										}
										echo '<a href="index.php?strona=' . $ileStron . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . $ileStron . '</a>';
									} else {
										echo '<a href="index.php?strona=1&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">1</a>';
										echo '<a href="index.php?strona=' . ($_GET['strona'] - 1) . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . ($_GET['strona'] - 1) . '</a>';
										echo '<a href="index.php?strona=' . $_GET['strona'] . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . $_GET['strona'] . '</a>';
										echo '<a href="index.php?strona=' . ($_GET['strona'] + 1) . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . ($_GET['strona'] + 1) . '</a>';
										echo '<a href="index.php?strona=' . $ileStron . '&Nazwa_Lokalu=' . $_GET['Nazwa_Lokalu'] . '&Min_Za_Dzien=' . $_GET['Min_Za_Dzien'] . '&Max_Za_Dzien=' . $_GET['Max_Za_Dzien'] . '">' . $ileStron . '</a>';
									}
								}
							}

						echo '</div>';
					}
					else{
						echo "<h1> Brak lokali do wynajęcia </h1>";
					}

			?>

		</article>
		
	</section>
    
	<footer>
        <?php require("../stopka.php"); ?>
    </footer>
	
</body>
		<?php
			$conn->close();
		?>
</html>