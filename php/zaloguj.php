<?php
// Rozpocznij sesję
session_start();

// Sprawdź, czy przesłane zostały login i hasło
if (!isset($_POST['login']) || !isset($_POST['haslo'])) {
    // Jeśli nie, przekieruj użytkownika do strony logowania i zakończ skrypt
    header('Location: Logowanie.php');
    exit();
}

// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require "connect.php";

// Nawiąż połączenie z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno != 0) {
    // Jeśli nie, wyświetl błąd połączenia i zakończ skrypt
    echo "Error:" . $polaczenie->connect_errno;
} else {
    // Pobierz login i hasło z przesłanych danych POST
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    // Przygotuj zapytanie SQL sprawdzające istnienie użytkownika o podanym loginie
    $stmt = $polaczenie->prepare("SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sprawdź, czy użytkownik o podanym loginie istnieje
    if ($result->num_rows > 0) {
        // Pobierz dane użytkownika
        $row = $result->fetch_assoc();

        // Sprawdź poprawność hasła za pomocą funkcji password_verify
        if (password_verify($haslo, $row['haslo'])) {
            // Ustaw sesję zalogowanego użytkownika
            $_SESSION['zalogowany'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['nazwa_uzytkownika'] = $row['nazwa_uzytkownika'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id_uzytkownika'] = $row['id_uzytkownika'];

            // Pobierz informacje o armiach przypisanych do zalogowanego użytkownika
            $sql_armie = "SELECT * FROM armie WHERE id_uzytkownika='" . $_SESSION['id_uzytkownika'] . "'";
            $armie = array();
            if ($rezultat_armie = $polaczenie->query($sql_armie)) {
                while ($wiersz_armii = $rezultat_armie->fetch_assoc()) {
                    $armie[] = $wiersz_armii;
                }
                $rezultat_armie->close();
            }

            // Ustaw sesję z informacjami o armiach
            $_SESSION['armie'] = $armie;

            // Pobierz informacje o wszystkich jednostkach
            $sql_jednostki = "SELECT * FROM jednostki";
            $jednostki = array();
            if ($rezultat_jednostki = $polaczenie->query($sql_jednostki)) {
                while ($wiersz_jednostki = $rezultat_jednostki->fetch_assoc()) {
                    $jednostki[] = $wiersz_jednostki;
                }
                $rezultat_jednostki->close();
            }

            // Ustaw sesję z informacjami o jednostkach
            $_SESSION['jednostki'] = $jednostki;

            // Usuń ewentualny błąd z sesji
            unset($_SESSION['blad']);

            // Przekieruj użytkownika do strony edycji jednostek
            header('Location: ../edycja_jednostek.php');
        } else {
            // Jeśli hasło nieprawidłowe, ustaw błąd w sesji i przekieruj użytkownika do strony logowania
            $_SESSION['blad'] = '<span style="color:red">Błędne hasło</span>';
            header('Location: ../logowanie.php');
        }
    } else {
        // Jeśli użytkownik o podanym loginie nie istnieje, ustaw błąd w sesji i przekieruj użytkownika do strony logowania
        $_SESSION['blad'] = '<span style="color:red">Błędny login</span>';
        header('Location: ../logowanie.php');
    }

    // Zamknij połączenie z bazą danych
    $polaczenie->close();
}
?>
