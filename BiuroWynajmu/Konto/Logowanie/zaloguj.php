<?php 

	require('../../config.php');
	session_start();

	if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }

	if(!isset($czyWykonene)){
		if(isset($_POST['formEmailUser'])){

			$email = filter_var($_POST['formEmailUser'], FILTER_VALIDATE_EMAIL);
			$haslo = $_POST['formPasswordUser'];
			
			$zapytanieNr1 = "SELECT * FROM uzytkownicy 
				INNER JOIN rola ON uzytkownicy.ID_Roli = rola.ID_Roli
				WHERE Email = '".$email."'";
			$conn = new mysqli($host, $user, $password, $database);
			$wykoanieniZapytanieNr1 = $conn->query($zapytanieNr1);

			if($wykoanieniZapytanieNr1 -> num_rows == 1){
				$row = $wykoanieniZapytanieNr1->fetch_object();
				$pobraneHaslo = $row->Haslo;

				if(password_verify($haslo, $pobraneHaslo)){
					$_SESSION['zalogowany'] = true;
					$_SESSION['ID_Uzytkownika'] = $row -> ID_Uzytkownika;
					$_SESSION['Imie'] = $row -> Imie;
					$_SESSION['Nazwisko'] = $row -> Nazwisko;
					$_SESSION['rola'] = $row -> Nazwa_Roli;

					$czyWykonene = true;
					
					header('Location: index.php');
					exit;
				}
				else{
					echo "Podano nieprawidłowy email lub hasło!";
				}
			}
			else{
				echo "Podano nieprawidłowy email lub hasło!";
			}

		}
	}



?>