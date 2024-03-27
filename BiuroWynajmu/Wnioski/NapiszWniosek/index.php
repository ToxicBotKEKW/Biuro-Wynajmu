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

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) || !isset($_GET['typ_wniosku']))
 
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
			<?php 
				if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
					echo '<a href="../">Wnioski</a>';
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

				if ($_GET['typ_wniosku'] == "Wynajem" && isset($_GET['ID_Lokalu'])) {
					echo '
						<h1>'.$_GET['typ_wniosku'].'</h1>
						<form action="podsumowanieWniosku.php" method="POST">
							<p>Uwaga! Jeżeli chcesz wynająć jakiś lokal, wniosek musi być złożony najpóźniej 7 dni przed planowanym okresem wynajmu!</p>

							<p>Lokal który chcesz wynająć: <a href="../../Lokale/Lokal/index.php?ID_Lokalu='.$_GET['ID_Lokalu'].'"> '.$_GET['ID_Lokalu'].' </a></p>

							<input type="hidden" value="'.$_GET['typ_wniosku'].'" name="typ_wniosku">
							<input type="hidden" value="'.$_GET['ID_Lokalu'].'" name="ID_Lokalu">

							<label for="data_poczatkowa_wynajmu">Data Początkowa Wynajmu:</label>
							<input type="date" name="data_poczatkowa_wynajmu">

							<label for="data_poczatkowa_wynajmu">Data Końcowa Wynajmu:</label>
							<input type="date" name="data_koncowa_wynajmu">

							<input type="submit" value="Do Podsumowania">
						</form>
					';
				} else if ($_GET['typ_wniosku'] == "Kredyt") {
					echo '
						<h1>'.$_GET['typ_wniosku'].'</h1>
						<form action="podsumowanieWniosku.php" method="POST">
							<input type="hidden" value="'.$_GET['typ_wniosku'].'" name="typ_wniosku">

							<label for="kwota_kredytu">Kwota Kredytu:</label>
							<input type="text" name="kwota_kredytu">

							<label for="ile_rat">Ile rat (min 8 / max 180):</label>
							<input type="number" min="8" max="180" name="ile_rat">

							<input type="submit" value="Do Podsumowania">
						</form>
					';
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