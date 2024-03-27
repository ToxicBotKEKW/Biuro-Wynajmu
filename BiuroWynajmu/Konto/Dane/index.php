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

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../Logowanie');
 
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
			<a href="../../Lokale/">Lokale</a>
			<a href="../../Wnioski/">Wnioski</a>
			<div class="dropdown">

				<?php 
					if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
						echo '
						
						<button class="dropbtn">'.$_SESSION['Imie'].' '.$_SESSION['Nazwisko'].'</button>
							<div class="dropdown-content">
								<a href="">Dane Konta</a>
								<a href="../WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="../MojeWnioski/">Moje Wnioski</a>
								<a href="../MojeKredyty/">Moje Kredyty</a>
								<a href="../MojeTranzakcje/">Moje Tranzakcje</a>
								<a href="../MojeZgloszenia/">Moje Zgłoszenia</a>
								<a href="../Wyloguj/logout.php">Wyloguj Się</a>
							</div>
						
						';
					}
					else{
						echo '<a href="../Logowanie/">Zaloguj się</a>';
					}
				?>
			</div> 
		</div>
    </header>
	
	<section>

		<article>

			<div id="PanelDaneOdnosniki">
				<a href="../Dane" class="activeLink"><img src="../../obrazki/Konto/user.png"></a>
				<a href="../WynajeteLokale"><img src="../../obrazki/Konto/home.png"></a>
				<a href="../MojeWnioski"><img src="../../obrazki/Konto/quote-request.png"></a>
				<a href="../MojeKredyty"><img src="../../obrazki/Konto/bank.png"></a>
				<a href="../MojeTranzakcje"><img src="../../obrazki/Konto/tranzakcja.png"></a>
				<a href="../MojeZgloszenia/"><img src="../../obrazki/Konto/zgloszenia.png"></a>
			</div>
			

			<div id="PanelDaneDaneUzytkownika">
				<h1>Dane Użytkownika</h1>
				
				<?php 
					$zapytanieNr1 = "SELECT * FROM uzytkownicy INNER JOIN adresy ON uzytkownicy.ID_Adres_Zamieszkania = adresy.ID_Adres WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";
					$wykoanieniZapytanieNr1 = $conn -> query($zapytanieNr1);
					$row = $wykoanieniZapytanieNr1->fetch_object();
				?>
				
				<h2>Dane osobowe:</h2>
					<p>Imie: <?php echo $row->Imie; ?></p>
					<p>Nazwisko: <?php echo $row->Nazwisko; ?> </p>
					<p>Email: <?php echo $row->Email; ?> </p>
					<p>Data Urodzenia: <?php echo $row->Data_Urodzenia; ?> </p>
				<h2>Adress zamieszkania:</h2>
					<p>Kod Pocztowy: <?php echo $row->Kod_Pocztowy; ?> </p>
					<p>Miejscowość: <?php echo $row->Miasto; ?> </p>
					<p>Ulica: <?php echo $row->Ulica; ?> </p>
					<p>Numer Budynku: <?php echo $row->Numer_Budynku; ?> </p>
					<p>Numer_Lokalu: <?php echo $row->Numer_Lokalu; ?> </p>
				<h2>Praca:</h2>
					<p>Aktualne Zarobki: <?php echo $row->Aktualne_Zarobki; ?> </p>
					<p>Stan Konta: <?php echo $row->Stan_Konta; ?> </p>
				<div id="odnosniki">
					<a href="AktualizacjaDanych/">Zaktualizauj Dane</a>
					<a href="DodajSrodki/">Dodaj Środki Na Konto</a>
				</div>
			</div>


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