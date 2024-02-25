<?php
// Rozpocznij sesję, aby obsługiwać sesje użytkownika
session_start();

// Połącz z bazą danych
require "php/connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych jest poprawne
if ($polaczenie->connect_errno) {
    echo "Error: " . $polaczenie->connect_errno;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Strona główna</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <?php include('html/header.php'); ?>

   <section class="regulamin">
      <h1 class="title">Regulamin korzystania ze strony</h1>

      <p>
         Prosimy o uważne przeczytanie poniższego regulaminu przed rozpoczęciem korzystania ze strony internetowej.
         Poprzez dostęp i korzystanie z tej strony internetowej akceptujesz warunki zawarte w niniejszym regulaminie.
         Jeśli nie zgadzasz się z którąkolwiek częścią regulaminu, prosimy o zaprzestanie korzystania ze strony.
      </p>

      <h2>1. Postanowienia ogólne</h2>

      <p>1.1. Niniejszy regulamin określa warunki korzystania ze strony internetowej dostępnej pod adresem [adres_strony].</p>
      <p>1.2. Właścicielem strony jest Jerzy Hutarz.</p>
      <p>1.3. Użytkownikami strony mogą być osoby fizyczne oraz prawne.</p>

      <h2>2. Korzystanie ze strony</h2>

      <p>2.1. Użytkownik zobowiązuje się do korzystania ze strony zgodnie z obowiązującymi przepisami prawa oraz zasadami moralności.</p>
      <p>2.2. Zabrania się dostarczania i publikowania na stronie treści obraźliwych, nielegalnych, szkalujących, wulgarnych lub naruszających prawa autorskie.</p>

      <h2>3. Odpowiedzialność</h2>

      <p>3.1. Właściciel strony nie ponosi odpowiedzialności za ewentualne szkody wynikłe z korzystania z serwisu,
         w tym utratę danych, przerwy w dostępie czy szkody finansowe.</p>
      <p>3.2. Strona może zawierać odnośniki do zewnętrznych stron internetowych,
         za treści zamieszczone na tych stronach właściciel strony nie ponosi odpowiedzialności.</p>

      <h2>4. Ochrona danych osobowych</h2>

      <p>4.1. Właściciel strony dba o ochronę prywatności użytkowników.
         Informacje na temat przetwarzania danych osobowych znajdują się w polityce prywatności dostępnej na stronie.</p>

      <h2>5. Zmiany w regulaminie</h2>

      <p>5.1. Właściciel strony zastrzega sobie prawo do dokonywania zmian w niniejszym regulaminie.
         Zmiany wchodzą w życie od momentu ich opublikowania na stronie.</p>
      <p>5.2. Użytkownicy są zobowiązani do regularnego sprawdzania treści regulaminu.</p>
   </section>

   <?php include('html/footer.php'); ?>

   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>
</body>
</html>
