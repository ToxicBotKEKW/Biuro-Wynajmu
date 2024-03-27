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
								<a href="../WynajeteLokale">Wyanjęte Lokale</a>
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
				<a href="../Dane"><img src="../../obrazki/Konto/user.png"></a>
				<a href="../WynajeteLokale" class="activeLink"><img src="../../obrazki/Konto/home.png"></a>
				<a href="../MojeWnioski"><img src="../../obrazki/Konto/quote-request.png"></a>
				<a href="../MojeKredyty"><img src="../../obrazki/Konto/bank.png"></a>
				<a href="../MojeTranzakcje"><img src="../../obrazki/Konto/tranzakcja.png"></a>
				<a href="../MojeZgloszenia/"><img src="../../obrazki/Konto/zgloszenia.png"></a>
			</div>
			

			<div id="PanelDaneDaneUzytkownika">
				<h1>Moje wynajęte lokale:</h1>
				
				<?php 

				$zapytanieNr1 = "SELECT * FROM wynajem 
					INNER JOIN uzytkownicy ON wynajem.ID_Uzytkownika = uzytkownicy.ID_Uzytkownika 
					INNER JOIN lokale ON wynajem.ID_Lokalu = lokale.ID_Lokalu
					INNER JOIN wnioski ON wnioski.ID_Wniosku = wynajem.ID_Wniosku
					INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
					WHERE wynajem.ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."
					AND Nazwa_Statusu = 'Zatwierdzony'";
				$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

				if($wynikZapytaniaNr1 -> num_rows > 0){
					while($row = $wynikZapytaniaNr1 -> fetch_object()){
						echo '<a href="../../Lokale/Lokal/index.php?ID_Lokalu='.$row->ID_Lokalu.'">';
							echo '<div class="daneLokalu">';
							
								echo '<div class="daneLokaluLewo">';
									echo '<img src="../Zdjecia/Lokale/'.$row->Zdjecie_Lokalu.'">';
								echo '</div>';
							
								echo '<div class="daneLokaluPrawo">';
									echo '<h1>'.$row->Nazwa_Lokalu.' ';
									
									
									if(date("Y-m-d") <= $row -> Data_Koncowa_Wynajmu){
										echo "(Wynajmujesz jeszcze ten lokal)";
									}
									else{
										echo "(Okres wynajmu się skończył)";
									}
									
									
									echo '</h1>';
									echo '<p>'.$row->Opis_Lokalu.'</p>';
								echo '</div>';
							
							echo '</div>';
						echo '</a>';
					}
				}
				else{
					echo "<h1> Nigdy nie wynajmowałeś żadnych lokali! </h1>";
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