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

	 if(!isset($_GET['ID_Kredytu'])){
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
			<a href="../../Wnioski/"><img src="../../../obrazki/Konto/quote-request.png"></a>
			<a href="../../Lokale/"><img src="../../../obrazki/Konto/home.png"></a>
			<a href="../../Wynajmy/" class="activeLink"><img src="../../../obrazki/Konto/wynajem.png"></a>
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

	 			
			<h1>Dane Kredytu</h1>

					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM kredyty
							WHERE ID_Kredytu = ".$_GET['ID_Kredytu']."
						";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if ($wynikZapytaniaNr1->num_rows == 1) {
							$row = $wynikZapytaniaNr1->fetch_object();
									echo '<p>Kwota Kredytu: '.$row->Kwota_Kredytu.'</p>';
									echo '<p>Do Spłacenia: '.$row->Do_Splacenia.'</p>';
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
											echo '<p>Kredyt nie spłacony.</p>';
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