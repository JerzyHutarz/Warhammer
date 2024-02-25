<?php
// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require "connect.php";

// Rozpocznij sesję
session_start();

// Połącz z bazą danych
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno) {
    // Jeśli błąd połączenia, ustaw komunikat błędu w sesji i zakończ działanie skryptu
    $_SESSION['usuniecie'] = "Error: " . $polaczenie->connect_errno;
    exit();
}

// Sprawdź, czy administrator jest zalogowany
if (!isset($_SESSION['admin'])) {
    // Jeśli administrator niezalogowany, ustaw komunikat w sesji i zakończ działanie skryptu
    $_SESSION['usuniecie'] = 'Administrator niezalogowany';
    exit();
}

// Sprawdź, czy żądanie przyszło metodą POST i czy przekazano parametr "usun"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usun'])) {
    // Pobierz nazwę jednostki do usunięcia z przekazanego parametru POST
    $nazwa_jednostki_do_usuniecia = $_POST['usun'];

    // Sprawdź, czy jednostka o podanej nazwie istnieje w bazie danych
    $stmt_check = $polaczenie->prepare("SELECT 1 FROM jednostki WHERE nazwa_jednostki = ?");
    $stmt_check->bind_param("s", $nazwa_jednostki_do_usuniecia);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // Jeśli jednostka istnieje, usuń ją z bazy danych
    if ($result_check->num_rows > 0) {
        $stmt_delete = $polaczenie->prepare("DELETE FROM jednostki WHERE nazwa_jednostki = ?");
        $stmt_delete->bind_param("s", $nazwa_jednostki_do_usuniecia);
        $stmt_delete->execute();
        $_SESSION['usuniecie'] = true;

        // Przekieruj administratora na stronę admina edycji jednostek po usunięciu jednostki
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'adminedit.php';
        header("Location: $referer");
        exit();
    } else {
        // Jeśli jednostka o podanej nazwie nie istnieje, ustaw komunikat w sesji
        $_SESSION['usuniecie'] = 'Jednostka o podanej nazwie nie istnieje.';
    }
}

// Zamknij połączenie z bazą danych
$polaczenie->close();
?>
