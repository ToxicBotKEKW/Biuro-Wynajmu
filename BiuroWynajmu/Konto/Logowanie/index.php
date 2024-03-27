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

	 if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }
	 ?>


</head>
<body>
	<header>
        <a href="../../"><- Powrót</a>
    </header>
	
	<section>

		<article>	
			<form action="zaloguj.php" method="POST">

				<h1>Logowanie</h1>

				<input type="text" id="formEmailUser" name="formEmailUser" placeholder="Email"><br>

				<input type="password" id="formPasswordUser" name="formPasswordUser" placeholder="Hasło"><br>

				<input type="submit" value="Zaloguj się" id="submitBtn">

				<p class="link"><a href="../Rejestracja">Zarejestruj się</a></p>
				
			</form>

		</article>
		
	</section>
    
	<footer>
        
    </footer>
	
</body>
</html>