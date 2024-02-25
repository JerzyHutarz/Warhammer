<?php
// Otwieranie sesji
session_start();

// Sprawdź, czy przesłano dane do logowania
if (!isset($_POST['login']) || !isset($_POST['haslo'])) {
    // Jeśli brak danych, przekieruj do strony logowania admina
    header('Location: ../admin.php');
    exit();
}

// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require "connect.php";

// Połącz z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_haslo, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno != 0) {
    echo "Error:" . $polaczenie->connect_errno;
} else {
    // Pobierz login i hasło z formularza
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    // Zabezpiecz login przed SQL injection (ponoć potrzebne)
    $login = $polaczenie->real_escape_string($login);

    // Przygotuj zapytanie SQL sprawdzające, czy istnieje użytkownik o podanym loginie
    $stmt = $polaczenie->prepare("SELECT * FROM users WHERE login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sprawdź, czy istnieje użytkownik o podanym loginie
    if ($result->num_rows > 0) {
        // Pobierz dane użytkownika
        $row = $result->fetch_assoc();

        // Sprawdź poprawność hasła
        if ($haslo === $row['haslo']) {
            // Jeśli hasło poprawne, ustaw sesję dla administratora
            $_SESSION['admin'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['login'] = $row['login'];

            // Sprawdź, czy zalogowany użytkownik to admin
            $_SESSION['admin'] = ($_SESSION['login'] == 'admin');

            // Wyczyść ewentualne wcześniejsze błędy (usuwa te która zostają przyrefreshowaniu strony)
            unset($_SESSION['blad']);

            // Przekieruj do strony admina (do edycji globalnej listy jednostek) po zalogowaniu
            header('Location: ../adminedit.php');
        } else {
            // Jeśli hasło niepoprawne, ustaw błąd i przekieruj do strony logowania
            $_SESSION['blad'] = '<span style="color:red">Niepoprawne hasło!</span>';
            header('Location: ../admin.php');
        }
    } else {
        // Jeśli użytkownik nie istnieje, ustaw błąd i przekieruj do strony logowania
        $_SESSION['blad'] = '<span style="color:red">Niepoprawny login!</span>';
        header('Location: ../admin.php');
    }

    // Zamknij przygotowane zapytanie i połączenie z bazą danych
    $stmt->close();
    $polaczenie->close();
}
?>
