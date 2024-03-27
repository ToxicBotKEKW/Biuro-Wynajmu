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

	 if(!isset($_GET['ID_Wniosku'])){
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
			<a href="../../Wnioski/" class="activeLink"><img src="../../../obrazki/Konto/quote-request.png"></a>
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

	 			
			<h1>Dane Wniosku</h1>

					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM wnioski
							INNER JOIN rodzaj_wniosku ON rodzaj_wniosku.ID_Rodzaj_Wniosku = wnioski.ID_Rodzaj_Wniosku
							INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
							WHERE ID_Wniosku = ".$_GET['ID_Wniosku']."
							ORDER BY Data_Wniosku
						";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if($wynikZapytaniaNr1 -> num_rows > 0){
							while($row = $wynikZapytaniaNr1 -> fetch_object()){
								
								echo '<p>ID_Wniosku: '.$row->ID_Wniosku.'</p>';
								echo '<p>ID Uzytkownika: <a href="../../Uzytkownicy/DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></p>';
								echo '<p>Rodzaj Wniosku: '.$row->Nazwa_Rodzaju_Wniosku.'</p>';
								
								if($row->Nazwa_Rodzaju_Wniosku == "Wynajem mieszkania"){
									$zapytanieNr2 = "SELECT * FROM wynajem WHERE ID_Wniosku = ".$row->ID_Wniosku."";
									$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

									if($wynikZapytaniaNr2 -> num_rows == 1){
										$row2 = $wynikZapytaniaNr2 -> fetch_object();
										echo '<p>ID Lokalu: <a href="../../Lokale/DaneLokalu/index.php?ID_Lokalu='.$row2->ID_Lokalu.'">'.$row2->ID_Lokalu.'</a></p>';

										$start_date = new DateTime($row2->Data_Poczatkowa_Wynajmu);
										$end_date = new DateTime($row2->Data_Koncowa_Wynajmu);

										echo '<p>Wynajem od '.$start_date->format('Y-m-d').' do '.$end_date->format('Y-m-d').'</p>';
									}
								}

								echo '<p>Data Wniosku: '.$row->Data_Wniosku.'</p>';
								echo '<p>Status Wniosku: '.$row->Nazwa_Statusu.'</p>';

								if($row->Nazwa_Statusu == "Oczekuje"){

									echo "<div id='coZWnioskiem'>";
										echo "<form action='akceptujWniosek.php' method='POST'>";
											echo "<input type='hidden' value='".$_GET['ID_Wniosku']."' name='ID_Wniosku'>";
											echo "<input type='submit' value='Akceptuj'>";
										echo "</form>";
										echo "<form action='odrzucWniosek.php' method='POST'>";
											echo "<input type='hidden' value='".$_GET['ID_Wniosku']."' name='ID_Wniosku'>";
											echo "<input type='submit' value='Odrzuć'>";
										echo "</form>";
									echo "</div>";
								}

																
							}
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