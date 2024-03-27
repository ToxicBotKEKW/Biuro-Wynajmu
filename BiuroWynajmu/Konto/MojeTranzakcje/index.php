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
								<a href="../Dane/">Dane Konta</a>
								<a href="../WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="../MojeWnioski/">Moje Wnioski</a>
								<a href="../MojeKredyty">Moje Kredyty</a>
								<a href="../MojeTranzakcje">Moje Tranzakcje</a>
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
				<a href="../Dane"><img src="../../obrazki/Konto/user.png"></a>
				<a href="../WynajeteLokale"><img src="../../obrazki/Konto/home.png"></a>
				<a href="../MojeWnioski"><img src="../../obrazki/Konto/quote-request.png"></a>
				<a href="../MojeKredyty"><img src="../../obrazki/Konto/bank.png"></a>
				<a href="../MojeTranzakcje" class="activeLink"><img src="../../obrazki/Konto/tranzakcja.png"></a>
				<a href="../MojeZgloszenia/"><img src="../../obrazki/Konto/zgloszenia.png"></a>
			</div>
			

			<div id="PanelDaneDaneUzytkownika">
				<h1>Moje Tranzakcje:</h1>
				
				<?php 

				$zapytanieNr1 = "SELECT * FROM tranzakcje
					INNER JOIN uzytkownicy ON uzytkownicy.ID_Uzytkownika = tranzakcje.ID_Uzytkownika
					WHERE tranzakcje.ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."
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
					echo "<p>Nigdy nie robiłeś żadnych tranzakcji</p>";
				}

			?>
				
				
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