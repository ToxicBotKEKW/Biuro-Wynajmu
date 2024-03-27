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

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../Logowanie');
 
		 exit();
 
	 }
	 ?>


</head>
<body>
	<header>
        <a href="../"><- Powrót</a>
    </header>
	
	<section>

		<article>	
			<form action="dodaj.php" method="POST">

				<h1>Dodaj środki</h1>

				<label for="formIloscSrodkow">Ilość środków którą chcesz dodać:</label><br>
				<input type="number" id="formIloscSrodkow" name="formIloscSrodkow"><br>

				<input type="submit" value="Dodaj środki" id="submitBtn">
				
			</form>

		</article>
		
	</section>
    
	<footer>
        
    </footer>
	
</body>
</html>