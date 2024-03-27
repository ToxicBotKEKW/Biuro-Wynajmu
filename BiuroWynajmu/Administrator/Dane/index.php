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
			<a href="../Dane/" class="activeLink"><img src="../../obrazki/Konto/dashboard.png"></a>
			<a href="../Uzytkownicy/"><img src="../../obrazki/Konto/user.png"></a>
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

	 			<div class="wykres">

	 				<h1>Najczęśćiej wynajmowane lokale</h1>
			
				<?php 
				
				// Zapytanie SQL do pobrania ilości wynajętych lokali z ostatnich 30 dni
					// Zapytanie do bazy danych - 10 najczęściej wynajmowanych lokali
					$sql = "SELECT Nazwa_Lokalu, COUNT(*) as LiczbaWynajec FROM wynajem
						JOIN lokale ON wynajem.ID_Lokalu = lokale.ID_Lokalu
						GROUP BY wynajem.ID_Lokalu
						ORDER BY LiczbaWynajec DESC
						LIMIT 10";

					$result = $conn->query($sql);

					// Pobranie danych do tablicy
					$data = array();
					while ($row = $result->fetch_assoc()) {
						$data[$row['Nazwa_Lokalu']] = $row['LiczbaWynajec'];
					}


					// Utworzenie kodu SVG dla wykresu kołowego
					echo '<svg width="600" height="500" xmlns="http://www.w3.org/2000/svg">';

					// Ustawienia kolorów
					$colors = array("#ff9999", "#66b3ff", "#99ff99", "#ffcc99", "#c2c2f0", "#ffb3e6", "#c2f0c2", "#ff6666", "#c2f0f0", "#ffcc00");
					$colorIndex = 0;

					// Wygenerowanie sektorów
					$startAngle = 0;
					foreach ($data as $label => $value) {
						$percentage = ($value / array_sum($data)) * 360;
						echo '<path fill="' . $colors[$colorIndex] . '" d="' . generateArcPath(200, 200, 150, $startAngle, $startAngle + $percentage) . '"/>';

						// Legenda
						echo '<rect x="400" y="' . (20 + $colorIndex * 25) . '" width="20" height="20" fill="' . $colors[$colorIndex] . '"/>';
						echo '<text x="425" y="' . (35 + $colorIndex * 25) . '" fill="' . $colors[$colorIndex] . '">' . $label . '</text>';

						$startAngle += $percentage;
						$colorIndex++;
					}

					echo '</svg>';


					// Funkcja do generowania ścieżki dla sektora kołowego
					function generateArcPath($cx, $cy, $r, $startAngle, $endAngle) {
						$startX = $cx + $r * cos(deg2rad($startAngle));
						$startY = $cy + $r * sin(deg2rad($startAngle));

						$endX = $cx + $r * cos(deg2rad($endAngle));
						$endY = $cy + $r * sin(deg2rad($endAngle));

						$largeArcFlag = ($endAngle - $startAngle <= 180) ? "0" : "1";

						$path = "M $cx $cy L $startX $startY A $r $r 0 $largeArcFlag 1 $endX $endY Z";
						return $path;
					}
					?>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>

				<div class="wykres">

					<h1>Inny wykres</h1>

				</div>



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