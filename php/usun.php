<?php
// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require "connect.php";

// Rozpocznij sesję
session_start();

// Połącz z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno) {
    // Jeśli błąd połączenia, ustaw komunikat błędu w sesji
    $_SESSION['usuniecie'] = "Error: " . $polaczenie->connect_errno;
    exit();
}

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['zalogowany'])) {
    // Jeśli użytkownik niezalogowany, ustaw komunikat w sesji i zakończ działanie skryptu
    $_SESSION['usuniecie'] = 'Użytkownik niezalogowany';
    exit();
}

// Sprawdź, czy żądanie przyszło metodą GET i czy przekazano identyfikator jednostki do usunięcia
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_armii_do_usuniecia'])) {
    // Pobierz identyfikator użytkownika z sesji i identyfikator jednostki do usunięcia z parametru GET
    $id_uzytkownika = $_SESSION['id_uzytkownika'];
    $id_armii_do_usuniecia = $_GET['id_armii_do_usuniecia'];

    // Sprawdź, czy jednostka o podanym identyfikatorze należy do danego użytkownika
    $stmt_check = $polaczenie->prepare("SELECT 1 FROM armie WHERE id_uzytkownika = ? AND id_armii = ?");
    $stmt_check->bind_param("ii", $id_uzytkownika, $id_armii_do_usuniecia);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // Jeśli jednostka należy do użytkownika, usuń ją
    if ($result_check->num_rows > 0) {
        $stmt_delete = $polaczenie->prepare("DELETE FROM armie WHERE id_uzytkownika = ? AND id_armii = ?");
        $stmt_delete->bind_param("ii", $id_uzytkownika, $id_armii_do_usuniecia);
        $stmt_delete->execute();
        $_SESSION['usuniete'] = true;

        // Przekieruj użytkownika na stronę edycji jednostek po usunięciu jednostki
        header("Location: ../edycja_jednostek.php");
        exit();
    } 
}

// Zamknij połączenie z bazą danych
$polaczenie->close();
?>
