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

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../Logowanie');
 
		 exit();
 
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>
	<div class="navbar">
			<a href="../../../">Strona Główna</a>
			<a href="../../../Lokale/">Lokale</a>
			<a href="../../../Wnioski/">Wnioski</a>
			<div class="dropdown">

				<?php 
					if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
						echo '
						
						<button class="dropbtn">'.$_SESSION['Imie'].' '.$_SESSION['Nazwisko'].'</button>
							<div class="dropdown-content">
								<a href="../">Dane Konta</a>
								<a href="../../WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="../../MojeWnioski/">Moje Wnioski</a>
								<a href="../../MojeKredyty/">Moje Kredyty</a>
								<a href="../../MojeTranzakcje/">Moje Tranzakcje</a>
								<a href="../../Wyloguj/logout.php">Wyloguj Się</a>
							</div>
						
						';
					}
					else{
						echo '<a href="../../Logowanie/">Zaloguj się</a>';
					}
				?>
			</div> 
		</div>
    </header>
	
	<section>

		<article>

			<div id="PanelDaneOdnosniki">
				<a href="../../Dane" class="activeLink"><img src="../../../obrazki/Konto/user.png"></a>
				<a href="../../WynajeteLokale"><img src="../../../obrazki/Konto/home.png"></a>
				<a href="../../MojeWnioski"><img src="../../../obrazki/Konto/quote-request.png"></a>
				<a href="../../MojeKredyty"><img src="../../../obrazki/Konto/bank.png"></a>
				<a href="../../MojeTranzakcje"><img src="../../../obrazki/Konto/tranzakcja.png"></a>
			</div>
			

			<div id="PanelDaneDaneUzytkownika">
				<h1>Dane Użytkownika</h1>
				
				<?php 
					$zapytanieNr1 = "SELECT * FROM uzytkownicy INNER JOIN adresy ON uzytkownicy.ID_Adres_Zamieszkania = adresy.ID_Adres WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
					$wykoanieniZapytanieNr1 = $conn->query($zapytanieNr1);
					$row = $wykoanieniZapytanieNr1->fetch_object();
				?>

				<form action="aktualizacjaDanych.php" method="post">
					<h2>Dane osobowe:</h2>
					<label for="imie">Imie:</label>
					<input type="text" name="imie" value="<?php echo $row->Imie; ?>">
					
					<label for="nazwisko">Nazwisko:</label>
					<input type="text" name="nazwisko" value="<?php echo $row->Nazwisko; ?>">
					
					<label for="data_urodzenia">Data Urodzenia:</label>
					<input type="date" name="data_urodzenia" value="<?php echo $row->Data_Urodzenia; ?>">
					
					<h2>Adres zamieszkania:</h2>
					<label for="kod_pocztowy">Kod Pocztowy:</label>
					<input type="text" name="kod_pocztowy" value="<?php echo $row->Kod_Pocztowy; ?>">
					
					<label for="miasto">Miejscowość:</label>
					<input type="text" name="miasto" value="<?php echo $row->Miasto; ?>">
					
					<label for="ulica">Ulica:</label>
					<input type="text" name="ulica" value="<?php echo $row->Ulica; ?>">
					
					<label for="numer_budynku">Numer Budynku:</label>
					<input type="number" name="numer_budynku" value="<?php echo $row->Numer_Budynku; ?>">
					
					<label for="numer_lokalu">Numer Lokalu:</label>
					<input type="number" name="numer_lokalu" value="<?php echo $row->Numer_Lokalu; ?>">
					
					<h2>Praca:</h2>
					<label for="aktualne_zarobki">Aktualne Zarobki:</label>
					<input type="number" name="aktualne_zarobki" value="<?php echo $row->Aktualne_Zarobki; ?>">
					
					<input type="submit" value="Zapisz zmiany">
				</form>
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