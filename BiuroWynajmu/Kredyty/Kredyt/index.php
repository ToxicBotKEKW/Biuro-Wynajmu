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

	if(!isset($_GET['ID_Kredytu'])){
		header('Location: ../../');
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


			$zapytanieNr1 = "SELECT * FROM kredyty
				WHERE ID_Kredytu = ".$_GET['ID_Kredytu']."
				AND ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']."";

			$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);

			if ($wynikZapytaniaNr1->num_rows == 1) {
				$row = $wynikZapytaniaNr1->fetch_object();
				echo '<div class="daneLokalu">';
					echo '<h1>Kredyt ' . $row->ID_Kredytu . '</h1>';
						echo '<p>Kwota Kredytu: '.$row->Kwota_Kredytu.'</p>';
						echo '<p>Ilość rat do spłacenia: '.$row->Ilosc_Rat_Do_Splacenia.'</p>';
						echo '<p>Rata Kredytu: '.$row->Rata_Kredytu.'</p>';
						echo '<p>Data wzięcia kredytu: '.$row->Data_Wziecia_Kredytu.'</p>';
						echo '<p>Ile spłaconych rat: '.$row->Ile_Splaconych_Rat.'</p>';
			
						if($row->Czy_Kredyt_Splacony == true){
							echo '<p>Data spłacenia kredytu: '.$row->Data_Splacenia_Kredytu.'</p>';
						}
						else{
							if($row->Ilosc_Rat_Do_Splacenia == $row->Ile_Splaconych_Rat){
								echo '<p>Data spłacenia kredytu: '.$row->Data_Splacenia_Kredytu.'</p>';
							}
							else{
								echo "<hr></hr>";
								echo "<form action='splacRaty.php' method='POST'>";
									echo "<input type='hidden' name='ID_Kredytu' value='".$row->ID_Kredytu."'>";
									echo "<label for='Ile_Chcesz_Splacic_Rat'>Ile chcesz spłacić rat:</label>";
									echo "<input type='number' name='Ile_Chcesz_Splacic_Rat' min='1' max='".$row->Ilosc_Rat_Do_Splacenia - $row->Ile_Splaconych_Rat."' value='1'>";
									echo "<input type='submit' value='Spłać raty'>";
								echo "</form>";
							}
						}

				echo '</div>';
			}  
			else {
				echo "<h1> Ten kredyt nie należy do ciebie! </h1>";
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