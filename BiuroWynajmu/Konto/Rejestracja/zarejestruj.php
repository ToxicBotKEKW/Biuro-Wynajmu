<?php
// Wczytanie konfiguracji i rozpoczęcie sesji
require('../../config.php');
session_start();

    if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
 
	 {
 
		 header('Location: ../../');
 
		 exit();
 
	 }

    $conn = new mysqli($host, $user, $password, $database);

    // Sprawdzenie, czy formularz został przesłany metodą POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Walidacja i oczyszczenie danych wprowadzonych przez użytkownika
        $imie = filter_var($_POST['formFirstNameUser'], FILTER_SANITIZE_STRING);
        $nazwisko = filter_var($_POST['formLastNameUser'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['formEmailUser'], FILTER_VALIDATE_EMAIL);
        $haslo = password_hash($_POST['formPasswordUser'], PASSWORD_DEFAULT); // Haszowanie hasła
        $dataUrodzenia = $_POST['formDateUser'];
        $aktualneZarobki = filter_var($_POST['formEarningsUser'], FILTER_VALIDATE_FLOAT);

        $kodPocztowy = filter_var($_POST['formKodPocztowyUser'], FILTER_SANITIZE_STRING);
        $miasto = filter_var($_POST['formMiastoUser'], FILTER_SANITIZE_STRING);
        $ulica = filter_var($_POST['formUlicaUser'], FILTER_SANITIZE_STRING);
        $numerBudynku = $_POST['formNumerBudynkuUser'];
        $numerLokalu = $_POST['formNumerLokaluUser'];
        $numerTelefonu = $_POST['formNumberPhoneUser'];

        if ($email !== false) {

            $zapytanieNr1 = "SELECT * FROM uzytkownicy WHERE Email = '".$email."'";
            $wynikaZapytaniNr1 = $conn -> query($zapytanieNr1);

            if($wynikaZapytaniNr1  -> num_rows == 0){

                // Wstawienie danych adresowych do bazy danych
                $zapytanieNr2 = "INSERT INTO adresy (Kod_Pocztowy, Miasto, Ulica, Numer_Budynku, Numer_Lokalu)
                                VALUES ('$kodPocztowy', '$miasto', '$ulica', '$numerBudynku', '$numerLokalu')";

                $wynikaZapytaniNr2 = $conn -> query($zapytanieNr2);

                if ($wynikaZapytaniNr2) {
                    // Pobranie ID nowo dodanego adresu
                    $addressID = mysqli_insert_id($conn);

                    // Wstawienie danych użytkownika do bazy danych
                    $zapytanieNr3 = "INSERT INTO uzytkownicy (Imie, Nazwisko, Email, Haslo, Data_Urodzenia, Numer_Telefonu, ID_Adres_Zamieszkania, Aktualne_Zarobki, ID_Roli)
                                VALUES ('$imie', '$nazwisko', '$email', '$haslo', '$dataUrodzenia', '$numerTelefonu', $addressID, $aktualneZarobki, '2')";

                    $wynikaZapytaniNr3 = $conn -> query($zapytanieNr3);

                    if ($wynikaZapytaniNr3) {
                        // Dodatkowa logika, jeśli wymagane...

                        // Przekierowanie do strony powodzenia lub strony logowania
                        header('Location: index.php');
                        exit;
                    } else {
                        // Obsługa błędu przy wstawianiu danych użytkownika
                        echo "Błąd podczas wstawiania danych użytkownika: " . mysqli_error($conn);
                    }
                } else {
                    // Obsługa błędu przy wstawianiu danych adresowych
                    echo "Błąd podczas wstawiania danych adresowych: " . mysqli_error($conn);
                }
            }
            else{
                header('Location: index.php');
                exit;
            }
        }
        else {
            echo "Email został niepoprawnie podany!";
        }
    } else {
        // Przekierowanie do formularza rejestracyjnego, jeśli dostęp bezpośredni bez danych POST
        header('Location: index.php');
        exit;
    }
?>