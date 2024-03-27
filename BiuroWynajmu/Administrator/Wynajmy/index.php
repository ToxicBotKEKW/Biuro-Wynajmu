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

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
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

		<div id="navbarLeft">
			<a href="../Dane/"><img src="../../obrazki/Konto/dashboard.png"></a>
			<a href="../Uzytkownicy/"><img src="../../obrazki/Konto/user.png"></a>
			<a href="../Wnioski/"><img src="../../obrazki/Konto/quote-request.png"></a>
			<a href="../Lokale/"><img src="../../obrazki/Konto/home.png"></a>
			<a href="../Wynajmy/" class="activeLink"><img src="../../obrazki/Konto/wynajem.png"></a>
			<a href="../Kredyty/"><img src="../../obrazki/Konto/bank.png"></a>
			<a href="../ZgloszeniaSerwisowe/"><img src="../../obrazki/Konto/zgloszenia.png"></a>
			<a href="../../"><img src="../../obrazki/Konto/logout.png"></a>
		</div>

		<div class="navbar">
			<div class="dropdown">
				<button class="dropbtn">...</button>
				<div class="dropdown-content">
					<a href="../Dane/">Dane Konta</a>
					<a href="../Uzytkownicy/">Użytkownicy</a>
					<a href="../Wnioski/">Wnioski</a>
					<a href="../Lokale/">Lokale</a>
					<a href="../Wynajmy/">Lokale</a>
					<a href="../Kredyty/">Kredyty</a>
					<a href="../ZgloszeniaSerwisowe/">Zgloszenia Serwisowe</a>
					<a href="../../">Wyjdz z Panelu Pracownika</a>
				</div>
		</div>
    </header>
	
	<section>

		<article>
			
			<div id="PanelDaneDaneUzytkownika">

	 			
			<h1>Wynajmy Użytkowników</h1>
	 			<table>
					<thead>
						<tr>
							<th>ID Wynajmu</th>
							<th>ID Użytkownika</th>
							<th>ID_Lokalu</th>
							<th>ID_Wniosku</th>
							<th>Data Wynajmu (Podstawowy)</th>
						</tr>
					</thead>

					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM wynajem
							INNER JOIN wnioski ON wnioski.ID_Wniosku = wynajem.ID_Wniosku
							WHERE ID_Status_Wniosku = 2
							ORDER BY Data_Koncowa_Wynajmu DESC
						";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if($wynikZapytaniaNr1 -> num_rows > 0){
							while($row = $wynikZapytaniaNr1 -> fetch_object()){
								
									echo '<tr>';
										echo '<td><a href="DaneWynajmu/index.php?ID_Wynajmu='.$row->ID_Wynajmu.'">'.$row->ID_Wynajmu.'</a></td>';
										echo '<td><a href="../Uzytkownicy/DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></td>';
										echo '<td><a href="../Lokale/DaneLokalu/index.php?ID_Lokalu='.$row->ID_Lokalu.'">'.$row->ID_Lokalu.'</a></td>';
										echo '<td><a href="../Wnioski/DaneWniosku/index.php?ID_Wniosku='.$row->ID_Wniosku.'">'.$row->ID_Wniosku.'</a></td>';
										echo '<td>Od '.$row->Data_Poczatkowa_Wynajmu.' do '.$row->Data_Koncowa_Wynajmu.'</td>';
									echo '</tr>';
								
							}
						}

					?>

				</table>


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