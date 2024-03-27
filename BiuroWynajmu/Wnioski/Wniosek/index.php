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

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) || !isset($_GET['ID_Wniosku']))
 
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
				$zapytanieNr1 = "SELECT * FROM wnioski 
					INNER JOIN rodzaj_wniosku ON wnioski.ID_Rodzaj_Wniosku = rodzaj_wniosku.ID_Rodzaj_Wniosku
					INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
					WHERE ID_Uzytkownika = ".$_SESSION['ID_Uzytkownika']." AND ID_Wniosku = ".$_GET['ID_Wniosku']."";
				$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);

				if ($wynikZapytaniaNr1->num_rows == 1) {
					$row = $wynikZapytaniaNr1->fetch_object();
					$typWniosku = $row->Nazwa_Rodzaju_Wniosku;
					
					echo '<h1>'.$typWniosku.'</h1>';
					echo '<p>Data złożenia wniosku: '.$row -> Data_Wniosku.'</p>';
					echo '<p>Status Wniosku: '.$row -> Nazwa_Statusu.'</p>';

					if ($typWniosku == "Wynajem mieszkania") {
						// Display information related to "Wynajem mieszkania"
						$zapytanieWynajem = "SELECT * FROM wynajem WHERE ID_Wniosku = ".$row->ID_Wniosku."";
						$wynikWynajem = $conn->query($zapytanieWynajem);
						if ($wynikWynajem->num_rows == 1) {
							$wynajemRow = $wynikWynajem->fetch_object();
							// Display or use data from $wynajemRow as needed
							echo "Wynajem mieszkania: ".$wynajemRow->ID_Lokalu;
						}
					} else if ($typWniosku == "Kredyt hipoteczny") {
						// Display information related to "Kredyt hipoteczny"
						$zapytanieKredyt = "SELECT * FROM kredyty WHERE ID_Wniosku = ".$row->ID_Wniosku."";
						$wynikKredyt = $conn->query($zapytanieKredyt);
						if ($wynikKredyt->num_rows == 1) {
							$kredytRow = $wynikKredyt->fetch_object();
							// Display or use data from $kredytRow as needed
							echo "Kredyt hipoteczny: ".$kredytRow->ID_Kredytu;
						}
					} else if ($typWniosku == "Przedłużenie wynajmu") {
						// Display information related to "Przedłużenie wynajmu"
						$zapytaniePrzedluzenie = "SELECT * FROM przedluzenie_wynajmu WHERE ID_Wniosku = ".$row->ID_Wniosku."";
						$wynikPrzedluzenie = $conn->query($zapytaniePrzedluzenie);
						if ($wynikPrzedluzenie->num_rows == 1) {
							$przedluzenieRow = $wynikPrzedluzenie->fetch_object();
							// Display or use data from $przedluzenieRow as needed
							echo "Przedłużenie wynajmu: ".$przedluzenieRow->ID_Przedluzenia;
						}
					} else {
						echo '<h1>Nieprawidłowy typ wniosku!</h1>';
					}
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