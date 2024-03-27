<?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		 header('Location: ../../../');
 
		 exit();
 
	 }

	 if(!isset($_POST['ID_Zgloszenia'])){
		header('Location: ../../../');
 
		exit();
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	$zapytanieNr1 = "SELECT * FROM zgloszenia_serwisowe
		INNER JOIN status_zgloszenia ON status_zgloszenia.ID_Status_Zgloszenia = zgloszenia_serwisowe.ID_Status_Zgloszenia
		WHERE ID_Zgloszenia = ".$_POST['ID_Zgloszenia']."
		AND Nazwa_Statusu = 'Oczekuje'
	";

	$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

	if($wynikZapytaniaNr1 -> num_rows == 1){
		$zapytanieNr2 = "UPDATE zgloszenia_serwisowe SET ID_Status_Zgloszenia = 4 WHERE ID_Zgloszenia = ".$_POST['ID_Zgloszenia']."";
		$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

		if($wynikZapytaniaNr2){
			echo 'ok';
		}
	}

	header('Location: index.php?ID_Zgloszenia='.$_POST['ID_Zgloszenia'].'');

	$conn->close();
?>
