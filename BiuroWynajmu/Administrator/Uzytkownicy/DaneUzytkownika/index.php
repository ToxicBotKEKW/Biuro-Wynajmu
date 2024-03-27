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
			<a href="../../Uzytkownicy/" class="activeLink"><img src="../../../obrazki/Konto/user.png"></a>
			<a href="../../Wnioski/"><img src="../../../obrazki/Konto/quote-request.png"></a>
			<a href="../../Lokale/"><img src="../../../obrazki/Konto/home.png"></a>
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

	 			<h1>Dane Użytkownika</h1>


					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM uzytkownicy 
							INNER JOIN adresy ON uzytkownicy.ID_Adres_Zamieszkania = adresy.ID_Adres 
							INNER JOIN rola ON uzytkownicy.ID_Roli = rola.ID_Roli
							WHERE ID_Uzytkownika = ".$_GET['ID_Uzytkownika']."";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if($wynikZapytaniaNr1 -> num_rows == 1){
							$row = $wynikZapytaniaNr1 -> fetch_object();
								
							echo '<h2>Dane osobowe:</h2>';
							echo '<p>Imie: ' . $row->Imie . '</p>';
							echo '<p>Nazwisko: ' . $row->Nazwisko . '</p>';
							echo '<p>Email: ' . $row->Email . '</p>';
							echo '<p>Data Urodzenia: ' . $row->Data_Urodzenia . '</p>';
							
							echo '<h2>Adres zamieszkania:</h2>';
							echo '<p>Kod Pocztowy: ' . $row->Kod_Pocztowy . '</p>';
							echo '<p>Miejscowość: ' . $row->Miasto . '</p>';
							echo '<p>Ulica: ' . $row->Ulica . '</p>';
							echo '<p>Numer Budynku: ' . $row->Numer_Budynku . '</p>';
							echo '<p>Numer Lokalu: ' . $row->Numer_Lokalu . '</p>';
							
							echo '<h2>Praca:</h2>';
							echo '<p>Aktualne Zarobki: ' . $row->Aktualne_Zarobki . '</p>';
							echo '<p>Stan Konta: ' . $row->Stan_Konta . '</p>';

							echo '<h2>Rola:</h2>';

							$zapytanieNr2 = "SELECT * FROM uzytkownicy 
								INNER JOIN adresy ON uzytkownicy.ID_Adres_Zamieszkania = adresy.ID_Adres 
								INNER JOIN rola ON uzytkownicy.ID_Roli = rola.ID_Roli
								WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

							$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

							$row2 = $wynikZapytaniaNr2 -> fetch_object();

							if(!($row->Nazwa_Roli == "Administrator")){
								if($row2->Nazwa_Roli == "Administrator"){
									echo '<p>'.$row->Nazwa_Roli.'</p>';
									echo '<form action="zmienRole.php" method="POST">';
										echo '<input type="hidden" name="ID_Uzytkownika" value='.$_GET['ID_Uzytkownika'].'>';
										echo '<select name="rola" value'.$row->Nazwa_Roli.'>';
											echo '<option value="Uzytkownik">Uzytkownik</option>';
											echo '<option value="Pracownik">Pracownik</option>';
										echo '</select>';
										echo '<input type="submit" value="Zapisz Zmianę Roli">';
									echo '</form>';
								}
								else{
									echo '<p>'.$row->Nazwa_Roli.'</p>';
								}
							}
							else{
								echo '<p>'.$row->Nazwa_Roli.'</p>';
							}


							echo '<h2>Tranzakcje:</h2>';

							echo '<div id="tranzakcje">';

							$zapytanieNr1 = "SELECT * FROM tranzakcje
								INNER JOIN uzytkownicy ON uzytkownicy.ID_Uzytkownika = tranzakcje.ID_Uzytkownika
								WHERE tranzakcje.ID_Uzytkownika = ".$_GET['ID_Uzytkownika']."
								ORDER BY Data_Tranzakcji DESC";

							$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

							if($wynikZapytaniaNr1 -> num_rows > 0){
								while($row = $wynikZapytaniaNr1 -> fetch_object()){
											echo '<details>';
												echo '<summary>';

													echo '<div class="wyswietlDane">'.$row->Tytul_Tranzakcji.'</div>';

													echo '<div class="oddzielacz"></div>';

													if($row->Kwota_Tranzakcji > 0){
														echo '<div class="wyswietlDane" style="color: darkgreen; font-weight: bold">Kwota tranzakcji: '.$row->Kwota_Tranzakcji.' PLN</div>';
													}
													else if($row->Kwota_Tranzakcji < 0){
														echo '<div class="wyswietlDane" style="color: darkred; font-weight: bold">Kwota tranzakcji: '.$row->Kwota_Tranzakcji.' PLN</div>';
													}

													echo '<div class="oddzielacz"></div>';

													echo '<div class="wyswietlDane">Data tranzakcji: '.$row->Data_Tranzakcji.'</div>';

												
												echo '</summary>';
												echo '<p>Opis tranzakcji: '.$row->Opis_Tranzakcji.'</p>';
												echo '<p>Stan konta przed tranzakcją: '.$row->Stan_Kont_Po_Tranzakcji - $row->Kwota_Tranzakcji.' PLN</p>';
												echo '<p>Stan konta po tranzakcją: '.$row->Stan_Kont_Po_Tranzakcji.' PLN</p>';
											echo '</details>';
								}
							}
							else{
								echo "<p>Ten użytkownik nie robiłtranzakcji</p>";
							}

							echo '</div>';

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