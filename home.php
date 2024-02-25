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
    <?php include('html/swiper.php'); ?>
    <?php include('html/rasy.php'); ?>
    <?php include('html/footer.php'); ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
