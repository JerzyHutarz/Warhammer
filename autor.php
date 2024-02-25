<?php
// Rozpocznij sesję
session_start();

// Wymagaj pliku connect.php
require "php/connect.php";

// Utwórz połączenie z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy wystąpił błąd podczas nawiązywania połączenia z bazą danych
if ($polaczenie->connect_errno) {
    echo "Error: " . $polaczenie->connect_errno;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Ustawienia metadanych -->
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Strona główna</title>

   <!-- Dodanie stylów Swipera -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- Dodanie ikon Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Dodanie własnych stylów -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include('html/header.php'); ?>
<?php include('html/swiper.php'); ?>

<div class="container">
   <div class="header">
      <h1>Witaj na mojej stronie!</h1>
      
      <!-- Kontener obrazka profilowego -->
      <div class="image-container">
         <img src="images/jerz.jpg" alt="Jerzy Hutarz" class="profile-image">
      </div>
   </div>

   <div class="tekst">
      <h2>O mnie</h2>
      <p>Nazywam się Jerzy Hutarz i witam na mojej stronie! Jestem pasjonatem gier komputerowych, planszowych oraz kolekcjonerskich gier karcianych. Lubię także pisać i tworzyć historie zarówno w formie opowiadań jak i sesji RPG. </p>
   </div>

   <div class="opis">
      <h2>Kim jestem</h2>
      <p>Jestem studentem drugiej młodości i wiem, że nie mam dużego doświadczenia IT. Ta strona jest moim pierwszym pełnym indywidualnym projektem wykraczającym poza standardowe zadania, z jakimi miałem do czynienia w trakcie nauki. Studia informatyczne stanowią dla mnie nie tylko ścieżkę kariery, ale także krok w stronę nowej pasji i nowego sposobu tworzenia i opowiadania historii. Wszechstronny każdy rodzaj tworzenia jest jednocześnie sposobem opowiadania.</p>
   </div>
   
   <div class="opis">
      <h2>Moje zainteresowania grami</h2>
      <p>Poza światem IT, moje zainteresowania obejmują szeroki przegląd gier. Uwielbiam zarówno wirtualne rozgrywki przy konsoli czy komputerze, jak i spotkania przy planszówkach czy kolekcjonerskich grach karcianych. To świetny sposób na relaks, rozwijanie umiejętności strategicznych i oczywiście dobrą zabawę.</p>
   </div>
   
   <div class="footer">
      &copy; 2023 Jerzy Hutarz. Wszelkie prawa zastrzeżone.
   </div>
</div>

<?php include('html/footer.php'); ?>

<!-- Dodanie skryptów-->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
