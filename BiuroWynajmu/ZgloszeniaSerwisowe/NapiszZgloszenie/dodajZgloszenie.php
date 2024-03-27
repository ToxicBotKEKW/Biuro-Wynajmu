<?php
// Connect to your database (replace these values with your actual database credentials)

	session_start();

	if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }
	 
	require('../../config.php');

	$conn = new mysqli($host, $user, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Common data for all types of applications

		$idLokalu = $_POST['ID_Lokalu'];
		$opisZgloszenia = $_POST['opis_zgloszenia'];

			$zapytanieNr1 = "SELECT * FROM lokale
					WHERE ID_Lokalu = ".$_POST['ID_Lokalu']."
				";

				$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

				if($wynikZapytaniaNr1->num_rows > 0){
					$zapytanieNr3 = "INSERT INTO zgloszenia_serwisowe (ID_Uzytkownika, ID_Lokalu, Opis_Problemu, ID_Status_Zgloszenia) VALUES (".$_SESSION['ID_Uzytkownika'].", ".$idLokalu.", '".$opisZgloszenia."', 1)";
					$wynikZapytaniaNr3 = $conn -> query($zapytanieNr3); 
				}
				
	}

	header("Location: ../../");


	$conn->close();
?>