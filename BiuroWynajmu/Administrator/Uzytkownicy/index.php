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

	if(!isset($_GET['strona'])){
		$_GET['strona'] = 1;
	}

	if(!isset($_GET['wyszukaj'] )){
		$_GET['wyszukaj'] = "";
	}

	if(!isset($_GET['ileWierszy'])){
		$_GET['ileWierszy'] = 25;
	}

	$conn = new mysqli($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>

		<div id="navbarLeft">
			<a href="../Dane/"><img src="../../obrazki/Konto/dashboard.png"></a>
			<a href="../Uzytkownicy/" class="activeLink"><img src="../../obrazki/Konto/user.png"></a>
			<a href="../Wnioski/"><img src="../../obrazki/Konto/quote-request.png"></a>
			<a href="../Lokale/"><img src="../../obrazki/Konto/home.png"></a>
			<a href="../Wynajmy/"><img src="../../obrazki/Konto/wynajem.png"></a>
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
				<h1>Użytkownicy w Bazie</h1>

				<!-- Formularz wyszukiwania -->
				<div id="wyszukiwanie">
					<form method="get" action="">
						<label for="wyszukaj"></label>
						<input type="text" id="wyszukaj" name="wyszukaj" placeholder="Szukaj">

						<label for="ileWierszy"></label>
						<select id="ileWierszy" name="ileWierszy">
							<option value="25">25 wierszy</option>
							<option value="50">50 wierszy</option>
							<option value="100">100 wierszy</option>
						</select>

						<input type="submit" value="Szukaj">
					</form>
				</div>

				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>E-mail</th>
							<th>Imię</th>
							<th>Nazwisko</th>
							<th>Data Założenia Konta</th>
						</tr>
					</thead>

					<?php 
						if(isset($_GET['wyszukaj'])){
							$search = $_GET['wyszukaj'];
							$zapytanieNr1 = "SELECT * FROM uzytkownicy WHERE ID_Uzytkownika LIKE '%$search%' OR Imie LIKE '%$search%' OR Nazwisko LIKE '%$search%' OR Email LIKE '%$search%'";
						} else {
							$zapytanieNr1 = "SELECT * FROM uzytkownicy";
						}

						$limit = isset($_GET['ileWierszy']) ? $_GET['ileWierszy'] : 25;
						$odIlu = $limit * ($_GET['strona']-1);

						$zapytanieNr1 .= "LIMIT $limit OFFSET $odIlu";
						$wynikZapytaniaNr1 = $conn->query($zapytanieNr1);

						if($wynikZapytaniaNr1->num_rows > 0){
							while($row = $wynikZapytaniaNr1->fetch_object()){
								echo '<tr>';
								echo '<td><a href="DaneUzytkownika/index.php?ID_Uzytkownika='.$row->ID_Uzytkownika.'">'.$row->ID_Uzytkownika.'</a></td>';
								echo '<td>'.$row->Email.'</td>';
								echo '<td>'.$row->Imie.'</td>';
								echo '<td>'.$row->Nazwisko.'</td>';
								echo '<td>'.$row->Data_Zalozenia_Konta.'</td>';
								echo '</tr>';
							}
						}

						
					?>
				</table>

				
			</div>

			<?php 

					echo '<div id="stronnicowanie">';

					$zapytanieNr2 = "SELECT COUNT(*) AS zlicz FROM uzytkownicy WHERE Imie LIKE '%$search%' OR Nazwisko LIKE '%$search%' OR Email LIKE '%$search%'";
					$wynikZapytaniaNr2 = $conn->query($zapytanieNr2);

					// Pobranie ilości wyników
					$row2 = $wynikZapytaniaNr2->fetch_object();
					$ileWynikow = $row2->zlicz;
					$ileStron = ceil($ileWynikow / $_GET['ileWierszy']);


					// Sprawdzenie ilości stron i utworzenie linków
					if ($ileStron > 1) {
						// Warunki dla małej liczby stron
						if ($ileStron < 5) {
							for ($i = 1; $i <= $ileStron; $i++) {
								echo '<a href="index.php?strona=' . $i . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . $i . '</a>';
							}
						} else {
							// Warunki dla większej liczby stron
							if ($_GET['strona'] <= 2) {
								for ($i = 1; $i <= 4; $i++) {
									echo '<a href="index.php?strona=' . $i . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . $i . '</a>';
								}
								echo '<a href="index.php?strona=' . $ileStron . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . $ileStron . '</a>';
							} else {
								echo '<a href="index.php?strona=1&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">1</a>';
								echo '<a href="index.php?strona=' . ($_GET['strona'] - 1) . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . ($_GET['strona'] - 1) . '</a>';
								echo '<a href="index.php?strona=' . $_GET['strona'] . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . $_GET['strona'] . '</a>';
								echo '<a href="index.php?strona=' . ($_GET['strona'] + 1) . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . ($_GET['strona'] + 1) . '</a>';
								echo '<a href="index.php?strona=' . $ileStron . '&wyszukaj=' . $_GET['wyszukaj'] . '&ileWierszy=' . $_GET['ileWierszy'] . '">' . $ileStron . '</a>';
							}
						}
					}

					echo '</div>';
				
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