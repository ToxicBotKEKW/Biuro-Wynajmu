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
 
		 header('Location: ../../');
 
		 exit();
 
	 }

	 if(!isset($_GET['ID_Wynajmu'])){
		header('Location: ../../');
 
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

	 			
			<h1>Dane Wynajmu</h1>

					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM wynajem
							WHERE ID_Wynajmu = ".$_GET['ID_Wynajmu']."
							ORDER BY Data_Koncowa_Wynajmu DESC
						";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if($wynikZapytaniaNr1 -> num_rows > 0){
							while($row = $wynikZapytaniaNr1 -> fetch_object()){
								
								echo '<p>ID Wynajmu: '.$row->ID_Wynajmu.'</p>';
								echo '<p>ID Uzytkownika: <a href="../../Uzytkownicy/DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></p>';
								echo '<p>ID Lokalu: <a href="../../Lokale/DaneLokalu/index.php?ID_Lokalu='.$row->ID_Lokalu.'">'.$row->ID_Lokalu.'</a></p>';
								echo '<p>ID Wniosku: <a href="../../Wnioski/DaneWniosku/index.php?ID_Wniosku='.$row->ID_Wniosku.'">'.$row->ID_Wniosku.'</a></p>';

								$dataPoczatkowa = new DateTime($row->Data_Poczatkowa_Wynajmu);
								$dataKoncowa = new DateTime($row->Data_Koncowa_Wynajmu);
									
								while ($dataPoczatkowa <= $dataKoncowa) {
									$zajeteDaty[] = $dataPoczatkowa->format('Y-m-d');
									$dataPoczatkowa->modify('+1 day');
								}

								echo '<p>Wszystkie daty pomiędzy:</p>';
								echo '<ul>';
								if (!empty($zajeteDaty)) {
									foreach($zajeteDaty as $data){
										echo '<li>'.$data.'</li>';
									}
								}
								echo '</ul>';
																
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