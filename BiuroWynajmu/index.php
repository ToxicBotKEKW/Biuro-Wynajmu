<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" type="text/css" href="style/style.css"/>
	 <title>Biuro Wynajmu</title>
	 <link rel="icon" href="obrazki/ikonka.png" type="image/icon type">
	 
	 <?php 
	 
	session_start();
	 
	require('config.php');

	$conn = mysqli_connect($host, $user, $password, $database);
	 
	 ?>

</head>
<body>
	<header>
        
		<div class="navbar">
			<a href="">Strona Główna</a>
			<a href="Lokale/">Lokale</a>
			<?php 
				if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
					echo '<a href="Wnioski/">Wnioski</a>';
				}
			?>
			<div class="dropdown">

				<?php 
					if(isset($_SESSION['zalogowany'])&& ($_SESSION['zalogowany']==true)){
						echo '
						
						<button class="dropbtn">'.$_SESSION['Imie'].' '.$_SESSION['Nazwisko'].'</button>
							<div class="dropdown-content">
								<a href="Konto/Dane/">Dane Konta</a>
								<a href="Konto/WynajeteLokale/">Wyanjęte Lokale</a>
								<a href="Konto/MojeWnioski/">Moje Wnioski</a>
								<a href="Konto/MojeKredyty/">Moje Kredyty</a>
								<a href="Konto/MojeTranzakcje/">Moje Tranzakcje</a>
								<a href="Konto/Wyloguj/logout.php">Wyloguj Się</a>
							</div>
						
						';
					}
					else{
						echo '<a href="Konto/Logowanie/">Zaloguj się</a>';
					}
				?>
			</div> 
		</div>

		
    </header>
	
	<section>

		<article>
			
			<h1>Infomracje</h1>

			<div id="informacje">
				<div class="informacjeBlok">
					<h2>O nas</h2>
					<p>
					Nasze biuro specjalizuje się w wynajmie nieruchomości o różnym standardzie. Oferujemy mieszkania, domy, lokale użytkowe
					i wiele więcej. Z nami znajdziesz idealne miejsce dostosowane do Twoich potrzeb.
					</p>
				</div>
				<div class="informacjeBlok">
					<h2>O nas</h2>
					<p>
					Nasze biuro specjalizuje się w wynajmie nieruchomości o różnym standardzie. Oferujemy mieszkania, domy, lokale użytkowe
					i wiele więcej. Z nami znajdziesz idealne miejsce dostosowane do Twoich potrzeb.
					</p>
				</div>
				<div class="informacjeBlok">
					<h2>O nas</h2>
					<p>
					Nasze biuro specjalizuje się w wynajmie nieruchomości o różnym standardzie. Oferujemy mieszkania, domy, lokale użytkowe
					i wiele więcej. Z nami znajdziesz idealne miejsce dostosowane do Twoich potrzeb.
					</p>
				</div>
				<div class="informacjeBlok">
					<h2>O nas</h2>
					<p>
					Nasze biuro specjalizuje się w wynajmie nieruchomości o różnym standardzie. Oferujemy mieszkania, domy, lokale użytkowe
					i wiele więcej. Z nami znajdziesz idealne miejsce dostosowane do Twoich potrzeb.
					</p>
				</div>
			</div>
		</article>
		
	</section>
    
	<footer>
        <?php require("stopka.php"); ?>
    </footer>
	
</body>
		<?php
			$conn->close();
		?>
</html>