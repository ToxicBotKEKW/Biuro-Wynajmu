<?php 
	 
	 session_start();

	 if (!(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) && !($_SESSION['rola'] == "Administrator" || $_SESSION['rola'] == "Pracownik"))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }

	 if(!isset($_POST['ID_Lokalu'])){
		header('Location: ../');
	 }
	 
	require('../../../config.php');

	$conn = new mysqli($host, $user, $password, $database);

	$ID_Lokalu = $_POST['ID_Lokalu'];

	$zapytanieNr0 = "SELECT * FROM lokale 
		INNER JOIN dostepnosc_lokalu ON lokale.ID_Dostepnosci = dostepnosc_lokalu.ID_Dostepnosci 
		INNER JOIN adresy ON adresy.ID_Adres = lokale.ID_Adres
		WHERE ID_Lokalu = ".$ID_Lokalu."";
	$wynikZapytaniaNr0 = $conn -> query($zapytanieNr0);

	if($wynikZapytaniaNr0 -> num_rows == 1){
		$row = $wynikZapytaniaNr0 -> fetch_object();

		if ($row->Nazwa_Dostepnosci == "Dostępny") {
			$zapytanieNr2 = "UPDATE lokale SET ID_Dostepnosci = 3 WHERE ID_Lokalu = ".$ID_Lokalu."";
			$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

			if($wynikZapytaniaNr2){
				echo 'ok';
			}
		}
		else{
			$zapytanieNr2 = "UPDATE lokale SET ID_Dostepnosci = 1 WHERE ID_Lokalu = ".$ID_Lokalu."";
			$wynikZapytaniaNr2 = $conn -> query($zapytanieNr2);

			if($wynikZapytaniaNr2){
				echo 'ok';
			}
		}
	}
	 
	header('Location: index.php?ID_Lokalu='.$ID_Lokalu.'');

	$conn -> close();
?>

