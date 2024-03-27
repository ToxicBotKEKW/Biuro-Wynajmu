<?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		 header('Location: ../../../');
 
		 exit();
 
	 }

	 if(!isset($_POST['ID_Wniosku'])){
		header('Location: ../../../');
 
		exit();
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);
	 
	$zapytanieNr1 = "SELECT * FROM wnioski
		INNER JOIN status_wniosek ON status_wniosek.ID_Status_Wniosku = wnioski.ID_Status_Wniosku
		WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."
		AND Nazwa_Statusu = 'Oczekuje'
	";

	$wynikZapytaniaNr1 = $conn -> query($zapytanieNr1);

	if($wynikZapytaniaNr1 -> num_rows == 1){
		$zapytanieNr2 = "UPDATE wnioski SET ID_Status_Wniosku = 3 WHERE ID_Wniosku = ".$_POST['ID_Wniosku']."";
		$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

		if($wynikZapytaniaNr2){
			echo 'ok';
		}
	}

	header('Location: index.php?ID_Wniosku='.$_POST['ID_Wniosku'].'');

	$conn->close();
?>
