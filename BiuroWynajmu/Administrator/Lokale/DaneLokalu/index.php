<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="style/style.css"/>
	 <title>Biuro Wynajmu</title>
	 <link rel="icon" href="../../../obrazki/ikonka.png" type="image/icon type">
	 
	 <?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		 header('Location: ../../../');
 
		 exit();
 
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>

		<div id="navbarLeft">
			<a href="../../Dane/"><img src="../../../obrazki/Konto/dashboard.png"></a>
			<a href="../../Uzytkownicy/"><img src="../../../obrazki/Konto/user.png"></a>
			<a href="../../Wnioski/"><img src="../../../obrazki/Konto/quote-request.png"></a>
			<a href="../../Lokale/" class="activeLink"><img src="../../../obrazki/Konto/home.png"></a>
			<a href="../../Wynajmy/"><img src="../../../obrazki/Konto/wynajem.png"></a>
			<a href="../../Kredyty/"><img src="../../../obrazki/Konto/bank.png"></a>
			<a href="../../ZgloszeniaSerwisowe/"><img src="../../../obrazki/Konto/zgloszenia.png"></a>
			<a href="../../../"><img src="../../../obrazki/Konto/logout.png"></a>
		</div>

		<div class="navbar">
			<div class="dropdown">
				<button class="dropbtn">...</button>
				<div class="dropdown-content">
					<a href="../../Dane/">Dane Konta</a>
					<a href="../../Uzytkownicy/">Użytkownicy</a>
					<a href="../../Wnioski/">Wnioski</a>
					<a href="../../Lokale/">Lokale</a>
					<a href="../../Wynajmy/">Lokale</a>
					<a href="../../Kredyty/">Kredyty</a>
					<a href="../../ZgloszeniaSerwisowe/">Zgloszenia Serwisowe</a>
					<a href="../../../">Wyjdz z Panelu Pracownika</a>
				</div>
		</div>
    </header>
	
	<section>

		<article>
			
			<div id="PanelDaneDaneUzytkownika">

	 			
			<?php

				$ID_Lokalu = $_GET['ID_Lokalu'];

				$zapytanieNr1 = "SELECT * FROM lokale 
					INNER JOIN dostepnosc_lokalu ON lokale.ID_Dostepnosci = dostepnosc_lokalu.ID_Dostepnosci 
					INNER JOIN adresy ON adresy.ID_Adres = lokale.ID_Adres
					WHERE ID_Lokalu = $ID_Lokalu";

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

					echo '<h2>Dostępność:</h2>';

					if ($row->Nazwa_Dostepnosci == "Dostępny") {
						echo "<p>Lokal jest dostępny do wynajmu!</p>";
						echo "<p>Po zmianie dostępności użytkownicy już nie będą mogli składać wniosków na wynajem tego lokalu! Po ostatnim wynajmi pracownicy biurwa wynajmu będą mogli przeprowadzić prace konserwacyjne.</p>";
						echo '<div id="odnosniki">';
							echo '<form action="zmien_dostepnosc.php" method="POST">';
								echo '<input type="hidden" value="'.$ID_Lokalu.'" name="ID_Lokalu">';
								echo '<input type="submit" value="Rozpocznij Prace Konserwacyjne">';
							echo '</form>';
						echo '</div>';
					}
					else{
						echo "<p>Lokal nie jest dostępny do wynajmu!</p>";
						echo '<div id="odnosniki">';
							echo '<form action="zmien_dostepnosc.php" method="POST">';
								echo '<input type="hidden" value="'.$ID_Lokalu.'" name="ID_Lokalu">';
								echo '<input type="submit" value="Skończ Prace Konserwacyjne">';
							echo '</form>';
						echo '</div>';
					}

					echo '<h2>Historia wynajmu:</h2>';

					$zapytanieNr4 = "SELECT * FROM wynajem
						WHERE ID_Lokalu = ".$ID_Lokalu."
						ORDER BY Data_Koncowa_Wynajmu DESC";
					$wynikZapytaniaNr4 = $conn -> query($zapytanieNr4);

					if($wynikZapytaniaNr4 -> num_rows > 0){
						echo '<table>';
							echo '<tr>';
								echo '<th>ID_Uzytkownika</th>';
								echo '<th>Data Początkowa Wynajmu</th>';
								echo '<th>Data Końcowa Wynajmu</th>';
							echo '</tr>';

							while($row = $wynikZapytaniaNr4 -> fetch_object()){
								echo '<tr>';
									echo '<td><a href="../../Uzytkownicy/DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></td>';
									echo '<td>'.$row->Data_Poczatkowa_Wynajmu.'</td>';
									echo '<td>'.$row->Data_Koncowa_Wynajmu.'</td>';
								echo '</tr>';
							}
						echo '</table>';
					}
					else{
						echo '<p>Lokal jeszcze nie był wynajmowany</p>';
					}

					echo '</div>';
				} else {
					echo 'Takie lokal nie isniteje';
				}

				?>

			</div>


		</article>
		
	</section>
    
	<footer>
        <?php require("../../../stopka.php"); ?>
    </footer>
	
</body>
		<?php
			$conn->close();
		?>
</html>