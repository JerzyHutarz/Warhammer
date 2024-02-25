<?php
// Rozpocznij sesję, aby obsługiwać sesje użytkownika
session_start();

// Wymagaj pliku zawierającego szczegóły połączenia z bazą danych
require "php/connect.php";

// Utwórz nowe połączenie mysqli przy użyciu podanych danych uwierzytelniających
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź błędy połączenia
if ($polaczenie->connect_errno) {
    echo "Błąd: " . $polaczenie->connect_errno;
    exit(); // Zakończ działanie skryptu w przypadku błędu połączenia
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

    <div class="tekst">
        <h2>Czym jest ta aplikacja webowa?</h2>
        <p>Jest to miejsce, gdzie możesz stworzyć swoje konto i swoją własną armię do gry bitewnej Warhammer 40k. Sama gra bitewna polega na prowadzeniu potyczek armiami plastikowych modeli. Każdy model ma frakcję do której przynależy i swój koszt. Właśnie ten punktowy koszt jest tym co opisuje rozmiar armii i ten koszt możesz śledzić po założeniu konta.</p>
    </div>

    <div class="opis">
        <h2>Najpierw <a href="rejestracja.php" class="link-style">rejestracja</a></h2>
        <p>By skorzystać ze strony musisz najpierw założyć konto rejestrując się.</p>
    </div>

    <div class="image-container">
        <img src="images/rejestracja.jpg" alt="war" class="instr-image">
    </div>

    <div class="opis">
        <h2>Następnie <a href="logowanie.php" class="link-style">zaloguj się</a></h2>
        <p>Potem prosty krok, logowanie.</p>
    </div>

    <div class="image-container">
        <img src="images/logowanie.jpg" alt="war" class="instr-image">
    </div>

    <div class="opis">
        <h2>Kolejny krok to <a href="edycja_jednostek.php" class="link-style">tworzenie</a> armii</h2>
        <p>Każda armia musi przynależeć do jakiejś frakcji. Możesz wybrać dowolną by przeczytać jej krótki opis. Jeśli już podejmiesz decyzję jaka frakcja Cię zainteresowała musisz...</p>
    </div>

    <div class="image-container">
        <img src="images/frakcje.jpg" alt="war" class="instr-image">
    </div>

    <div class="opis">
        <h2>...dodać <a href="lista.php" class="link-style">jednostki</a> do swojej armii</h2>
        <p>Możesz klikając przycisk "dodaj" dodawać kolejne jednostki do swojej armii. Na stronie <a href="edycja_jednostek.php" class="link-style">swojej armii</a> możesz sprawdzić jednostki oraz sumę ich punktów. Większość gier rozgrywa się armiami mającymi 1000, 2000 albo 3000 pkt. Strona nie pozwoli tworzyć armii z różnych frakcji, takie armie są niezgodne z zasadami gry.</p>
    </div>

    <div class="image-container">
        <img src="images/jednostki.jpg" alt="war" class="instr-image">
    </div>

    <div class="opis">
        <h2>A następnie je <a href="edycja_jednostek.php" class="link-style">usunąć</a></h2>
        <p>Przycisk "usuń" przy tabeli armii pozwala usuwać jednostki jakich nie chcemy już bądź jakie zostały omyłkowo dodane.</p>
    </div>

    <div class="image-container">
        <img src="images/usun.jpg" alt="war" class="instr-image">
    </div>

    <div class="opis">
        <h2>Pod listoją swojej <a href="edycja_jednostek.php" class="link-style">armii</a> znajduje się suma punktów.</h2>
        <p>Każda armia ma swój koniec. W tym przypadku mówimy o końcu tworzenia i tym końcem jest suma punktów armii. Tutaj możesz zobaczyć czy Twoja armia mieści się w ramach punktowych ustalonej bitwy.</p>
    </div>

    <div class="image-container">
        <img src="images/suma.jpg" alt="war" class="instr-image">
    </div>

    <?php include('html/footer.php'); ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
