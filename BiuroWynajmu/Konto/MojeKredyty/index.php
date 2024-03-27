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
				<a href="../WynajeteLokale"><img src="../../obrazki/Konto/home.png"></a>
				<a href="../MojeWnioski"><img src="../../obrazki/Konto/quote-request.png"></a>
				<a href="../MojeKredyty/" class="activeLink"><img src="../../obrazki/Konto/bank.png"></a>
				<a href="../MojeTranzakcje"><img src="../../obrazki/Konto/tranzakcja.png"></a>
				<a href="../MojeZgloszenia/"><img src="../../obrazki/Konto/zgloszenia.png"></a>
			</div>
			

			<div id="PanelDaneDaneUzytkownika">
				<h1>Moje kredyty:</h1>
				
				<?php 

				$zapytanieNr1 = "SELECT * FROM kredyty 
					INNER JOIN uzytkownicy ON kredyty.ID_Uzytkownika = uzytkownicy.ID_Uzytkownika 
					INNER JOIN wnioski ON wnioski.ID_Wniosku = kredyty.ID_Wniosku
					INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
					WHERE kredyty.ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']." 
					AND Nazwa_Statusu = 'Zatwierdzony'
					ORDER BY Data_Wziecia_Kredytu";
				$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

				if($wynikZapytaniaNr1 -> num_rows > 0){
					while($row = $wynikZapytaniaNr1 -> fetch_object()){
						echo '<a href="../../Kredyty/Kredyt/index.php?ID_Kredytu='.$row->ID_Kredytu.'">';
							echo '<div class="daneKredytu">';
								echo '<div class="daneKredytuPrawo">';
									echo '<h1>Kredyt '.$row->ID_Kredytu.'</h1>';
									echo '<p>Rata Kredytu: '.$row->Rata_Kredytu.'</p>';
								echo '</div>';
							
							echo '</div>';
						echo '</a>';
					}
				}
				else{
					echo "<h1> Nigdy nie brałeś kredytów </h1>";
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