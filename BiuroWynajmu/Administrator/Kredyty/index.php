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
			<a href="../Wynajmy/"><img src="../../obrazki/Konto/wynajem.png"></a>
			<a href="../Kredyty/" class="activeLink"><img src="../../obrazki/Konto/bank.png"></a>
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

	 			
			<h1>Kredyty Użytkowników</h1>
	 			<table>
					<thead>
						<tr>
							<th>ID Kredytu</th>
							<th>ID Użytkownika</th>
							<th>ID Wniosku</th>
							<th>Kwota Kredytu</th>
							<th>Kwota Do Spłacenia</th>
							<th>Data Wziecia Kredytu</th>
							<th>Czy Spłacony</th>
						</tr>
					</thead>

					<?php 
					
	 					$zapytanieNr1 = "SELECT * FROM kredyty
						";

						$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

						if($wynikZapytaniaNr1 -> num_rows > 0){
							while($row = $wynikZapytaniaNr1 -> fetch_object()){
								
									echo '<tr>';
										echo '<td><a href="DaneKredytu/index.php?ID_Kredytu='.$row->ID_Kredytu.'">'.$row->ID_Kredytu.'</a></td>';
										echo '<td><a href="../Uzytkownicy/DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></td>';
										echo '<td><a href="../Wnioski/DaneWniosku/index.php?ID_Wniosku='.$row->ID_Wniosku.'">'.$row->ID_Wniosku.'</a></td>';
										echo '<td>'.$row->Kwota_Kredytu.'</td>';
										echo '<td>'.$row->Do_Splacenia.'</td>';
										echo '<td>'.$row->Data_Wziecia_Kredytu.'</td>';
										echo '<td>';
										
										if($row->Czy_Kredyt_Splacony == 1){
											echo 'tak';
										}
										else{
											echo 'nie';
										}
										
										echo'</td>';
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