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

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['zalogowany'])) {
    // Przekieruj na stronę logowania, jeśli użytkownik nie jest zalogowany
    header('Location: logowanie.php');
    exit();
}

// Komunikat o usuniętej jednostce
$usunieteMessage = "";

// Sprawdź, czy sesja zawiera informację o usuniętej jednostce
if (isset($_SESSION['usuniete']) && $_SESSION['usuniete']) {
    $usunieteMessage = "Jednostka usunięta!";
    unset($_SESSION['usuniete']);
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

    <!-- Sekcja informacji o armii -->
    <section class="army-info">
        <!-- Komunikat o usuniętej jednostce -->
        <?php if (!empty($usunieteMessage)) : ?>
            <div class="error">
                <p><?php echo $usunieteMessage; ?></p>
            </div>
        <?php endif; ?>

        <?php
        // Sprawdź, czy sesja zawiera identyfikator użytkownika
        if (isset($_SESSION['id_uzytkownika'])) {
            $id_uzytkownika = $_SESSION['id_uzytkownika'];

            // Zapytanie o armie użytkownika
            $sql_armie = "SELECT id_jednostki, id_armii FROM armie WHERE id_uzytkownika='$id_uzytkownika'";
            $result = $polaczenie->query($sql_armie);
//wyświetlanie nagłówków tablicy
            if ($result->num_rows > 0) {  
                echo "<h2>Lista jednostek</h2>";
                echo "<table id='armieTable' class='table-style'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th class='table-cell' onclick='sortTable(0)'>Nazwa Jednostki</th>";
                echo "<th class='table-cell' onclick='sortTable(1)'>Frakcja</th>";
                echo "<th class='table-cell' onclick='sortTable(2)'>Ilość Modeli</th>";
                echo "<th class='table-cell' onclick='sortTable(3)'>Koszt Punktów</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                $suma_kosztow = 0;
                
                while ($row = $result->fetch_assoc()) {
                    $id_jednostki = $row['id_jednostki'];
                    $id_armii = $row['id_armii'];
                    
                    // Zapytanie o szczegóły jednostki
                    $sql_jednostka = "SELECT * FROM jednostki WHERE id='$id_jednostki'";
                    $result_jednostka = $polaczenie->query($sql_jednostka);
                    
                    if ($result_jednostka->num_rows > 0) {
                        $jednostka = $result_jednostka->fetch_assoc();
                        //wyświetlanie tablicy
                        echo "<tr>";
                        echo "<td>" . $jednostka['nazwa_jednostki'] . "</td>";
                        echo "<td>" . $jednostka['frakcja'] . "</td>";
                        echo "<td>" . $jednostka['ilosc_modeli'] . "</td>";
                        echo "<td class='total-points'>" . $jednostka['koszt_punktow'] . "</td>";
                        echo "<td><a class='btn' href='php/usun.php?id_armii_do_usuniecia=" . $id_armii . "'>Usuń</a></td>";
                        echo "</tr>";
                        
                        $suma_kosztow += $jednostka['koszt_punktow'];
                    }
                }
                
                echo "<tr>";
                echo "<td colspan='3' class='total-point'>Łącznie punktów:</td>";
                echo "<td class='total-point'>" . $suma_kosztow . "</td>";
                echo "<td></td>";
                echo "</tr>";
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<h3><a href='lista.php' style='text-decoration: none; color: inherit;'>Nie masz żadnych armii.</a></h3>";
            }
        }
        ?>
    </section>
    
    <!-- Sekcja z informacjami o innych rasach w świecie Warhammer 40k -->
    <?php include('html/rasy.php'); ?>
    
    <!-- Stopka strony z dodanym skryptem Swipera -->
    <?php include('html/footer.php'); ?>
</body>
</html>
