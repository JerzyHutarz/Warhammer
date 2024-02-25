<?php
// Rozpocznij sesję
session_start();

// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require "connect.php";

// Połącz z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno) {
    // Jeśli błąd połączenia, ustaw komunikat błędu w sesji
    $_SESSION['dodanie'] = "Error: " . $polaczenie->connect_errno;
    exit();
}

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['zalogowany'])) {
    // Jeśli użytkownik niezalogowany, ustaw komunikat w sesji i przekieruj do strony logowania
    $_SESSION['dodanie'] = '<span style="color:red">Najpierw musisz się zalogować!</span>';
    header("Location: ../logowanie.php");
    exit();
}

// Sprawdź, czy przesłano dane POST i czy przycisk "dodaj" został naciśnięty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dodaj'])) {
    // Pobierz dane z sesji i formularza
    $id_uzytkownika = $_SESSION['id_uzytkownika'];
    $nazwa_armii = "armia";
    $id_jednostki = $_POST['dodaj'];

    // Przygotuj zapytanie sprawdzające, czy jednostka o podanym id istnieje
    $stmt = $polaczenie->prepare("SELECT * FROM jednostki WHERE id = ?");
    $stmt->bind_param("i", $id_jednostki);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sprawdź, czy jednostka istnieje
    if ($result->num_rows > 0) {
        // Pobierz frakcję jednostki
        $jednostka = $result->fetch_assoc();
        $frakcjaJed = $jednostka['frakcja'];

        // Przygotuj zapytanie sprawdzające, czy użytkownik ma jakąkolwiek jednostkę w armii
        $stmt_check = $polaczenie->prepare("SELECT id_jednostki FROM armie WHERE id_uzytkownika = ? LIMIT 1");
        $stmt_check->bind_param("i", $id_uzytkownika);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        // Sprawdź, czy użytkownik ma jakąkolwiek jednostkę wi
        if ($result_check->num_rows > 0) {
            // Pobierz id jednostki w armii
            $row = $result_check->fetch_assoc();
            $id_jednostki_armii = $row['id_jednostki'];

            // Pobierz frakcję jednostki w armii
            $stmt_jednostka = $polaczenie->prepare("SELECT frakcja FROM jednostki WHERE id = ?");
            $stmt_jednostka->bind_param("i", $id_jednostki_armii);
            $stmt_jednostka->execute();
            $result_jednostka = $stmt_jednostka->get_result();

            // Sprawdź, czy frakcje jednostek się zgadzają
            if ($result_jednostka->num_rows > 0) {
                $row_jednostka = $result_jednostka->fetch_assoc();
                $frakcjaarm = $row_jednostka['frakcja'];

                // Porównaj frakcje dodawanej jednostki i jednostki z istniejącej armii i ustaw zmienną "zlafrakcja" jeśli się nie zgadzają
                if ($frakcjaJed != $frakcjaarm) {
                    $_SESSION['zlafrakcja'] = true;
                } else {
                    // Dodaj jednostkę do armii zalogowanego użytkownika, jeśli frakcje są takie same
                    $stmt_add = $polaczenie->prepare("INSERT INTO armie (id_uzytkownika, nazwa_armii, id_jednostki) VALUES (?, ?, ?)");
                    $stmt_add->bind_param("iss", $id_uzytkownika, $nazwa_armii, $id_jednostki);
                    $stmt_add->execute();
                    $_SESSION['dodane'] = true;
                }
            }
        } else {
            // Dodaj jednostkę do armii, jeśli użytkownik nie ma jeszcze żadnej jednostki
            $stmt_add = $polaczenie->prepare("INSERT INTO armie (id_uzytkownika, nazwa_armii, id_jednostki) VALUES (?, ?, ?)");
            $stmt_add->bind_param("iss", $id_uzytkownika, $nazwa_armii, $id_jednostki);
            $stmt_add->execute();
            $_SESSION['dodane'] = true;
        }
    }
}

// Zamknij połączenie z bazą danych
$polaczenie->close();

// Przekieruj użytkownika na poprzednią stronę (referer)
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
header("Location: $referer");
exit();
?>
