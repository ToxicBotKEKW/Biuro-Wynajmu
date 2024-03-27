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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#formEmailUser").on("blur", function() {
                var email = $(this).val();
                var checkboxChecked = $("#formCheckRegulaminUser").is(":checked");
       			 if (email !== "") {
                    $.ajax({
                        type: "POST",
                        url: "sprawdz_email.php", // Plik PHP, który sprawdzi, czy e-mail już istnieje w bazie
                        data: { email: email },
                        success: function(response) {
                            if (response === "istnieje") {
                                $("#infoEmailUser").text("E-mail już istnieje w bazie");
								$("#infoEmailUser").css("color", "red");
								if (checkboxChecked) {
									$("#submitBtn").prop("disabled", false);
								} else {
									$("#submitBtn").prop("disabled", true);
								}
                            } else {
                                $("#infoEmailUser").text("Ten adress email nie jest zajęty");
								$("#infoEmailUser").css("color", "green");
								if (checkboxChecked) {
									$("#submitBtn").prop("disabled", false);
								} else {
									$("#submitBtn").prop("disabled", true);
								}
                            }
                        }
                    });
                } else {
					$("#submitBtn").prop("disabled", true);
				}
            });


			$("#formCheckRegulaminUser").on("change", function() {
				var email = $("#formEmailUser").val();
				var checkboxChecked = $(this).is(":checked");

				if (email !== "" && checkboxChecked) {
					$("#submitBtn").prop("disabled", false);
				} else {
					$("#submitBtn").prop("disabled", true);
				}
			});
        });
    </script>

</head>
<body>
	<header>
        <a href="../../"><- Powrót</a>
    </header>
	
	<section>

		<article>
			<h1>Formularz Rejestracji</h1>
			
			<form action="zarejestruj.php" method="POST">

				<h2>Główne Dane:</h2>

				<label for="formFirstNameUser">Imię:</label><br>
				<input type="text" id="formFirstNameUser" name="formFirstNameUser"><br>

				<label for="formLastNameUser">Nazwisko:</label><br>
				<input type="text" id="formLastNameUser" name="formLastNameUser"><br>

				<label for="formEmailUser">Email:</label><br>
				<input type="text" id="formEmailUser" name="formEmailUser"><div id="infoEmailUser" style="color: red;"></div><br>

				<label for="formPasswordUser">Hasło:</label><br>
				<input type="password" id="formPasswordUser" name="formPasswordUser"><br>

				<label for="formDateUser">Data Urodzenia:</label><br>
				<input type="date" id="formDateUser" name="formDateUser"><br>

				<label for="formEarningsUser">Aktualne Zarobki:</label><br>
				<input type="number" id="formEarningsUser" name="formEarningsUser"><br>

				<h2>Dane teleadresowe:</h2>

				<label for="formKodPocztowyUser">Kod Pocztowy:</label><br>
				<input type="text" id="formKodPocztowyUser" name="formKodPocztowyUser"><br>

				<label for="formMiastoUser">Miasto:</label><br>
				<input type="text" id="formMiastoUser" name="formMiastoUser"><br>

				<label for="formUlicaUser">Ulica:</label><br>
				<input type="text" id="formUlicaUser" name="formUlicaUser"><br>

				<label for="formNumerBudynkuUser">Numer Budynku:</label><br>
				<input type="number" id="formNumerBudynkuUser" name="formNumerBudynkuUser"><br>

				<label for="formNumerLokaluUser">Numer Lokalu:</label><br>
				<input type="number" id="formNumerLokaluUser" name="formNumerLokaluUser"><br>

				<label for="formNumberPhoneUser">Numer Telefonu:</label><br>
				<input type="number" id="formNumberPhoneUser" name="formNumberPhoneUser"><br>

				<input type="checkbox" id="formCheckRegulaminUser" name="formCheckRegulaminUser">
				<label for="formCheckRegulaminUser">Akceptuje <a href="">regulamin</a></label><br>

				<input type="submit" value="Zarejestruj" id="submitBtn" disabled>
				
			</form>

		</article>
		
	</section>
    
	<footer>
        
    </footer>
	
</body>
</html>