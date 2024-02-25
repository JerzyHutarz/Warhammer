<?php
// Rozpocznij sesję
session_start();

// Wymagaj pliku connect.php z danymi do połączenia z bazą danych
require_once('connect.php');

// Połącz z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdź, czy połączenie z bazą danych powiodło się
if ($polaczenie->connect_errno != 0) {
    // Jeśli błąd połączenia, wyświetl komunikat błędu
    echo "Error:" . $polaczenie->connect_errno;
} else {
    // Sprawdź, czy formularz został wysłany (submit)
    if (isset($_POST['send'])) {
        // Pobierz dane z formularza
        $login = $_POST['login'];
        $email = $_POST['email'];
        $haslo = $_POST['haslo'];
        $powtorz_haslo = $_POST['powtorz_haslo'];

        // Ustaw dane w sesji dla zachowania wprowadzonych danych w przypadku błędu
        $_SESSION['login'] = $login;
        $_SESSION['email'] = $email;

        // Sprawdź poprawność danych (np. długość loginu, siła hasła, zgodność haseł, poprawny email)
        if (!preg_match('/^[a-zA-Z0-9]{4,20}$/', $login)) {
            $_SESSION['blad'] = "Login musi składać się z 4-20 liter bądź cyfr. Nie może zawierać spacji i polskich znaków.";
            header('Location: ../rejestracja.php');
            exit();
        }

        if (strlen($haslo) < 8 || !preg_match('/[0-9]/', $haslo)) {
            $_SESSION['blad'] = "Hasło musi zawierać przynajmniej 8 znaków, w tym przynajmniej jedną cyfrę.";
            header('Location: ../rejestracja.php');
            exit();
        }

        if ($haslo != $powtorz_haslo) {
            $_SESSION['blad'] = "Podane hasła nie są identyczne.";
            header('Location: ../rejestracja.php');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['blad'] = "Podaj poprawny adres e-mail.";
            header('Location: ../rejestracja.php');
            exit();
        }

        // Sprawdź, czy użytkownik o podanej nazwie lub adresie e-mail już istnieje
        $stmt = $polaczenie->prepare("SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika = ? OR email = ?");
        $stmt->bind_param("ss", $login, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Jeśli użytkownik już istnieje, wyświetl odpowiedni komunikat
        if ($user) {
            if ($user['nazwa_uzytkownika'] == $login) {
                $_SESSION['blad'] = "Podana nazwa użytkownika jest już zajęta.";
            }
            if ($user['email'] == $email) {
                $_SESSION['blad'] = "Podany adres e-mail jest już używany.";
            }

            header('Location: ../rejestracja.php');
            exit();
        }

        // Zahaszuj hasło przed dodaniem do bazy danych
        $haslo_haszowane = password_hash($haslo, PASSWORD_DEFAULT);

        // Dodaj użytkownika do bazy danych
        $stmt = $polaczenie->prepare("INSERT INTO uzytkownicy (nazwa_uzytkownika, email, haslo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $email, $haslo_haszowane);
        $stmt->execute();

        // Ustaw flagę oznaczającą udane zarejestrowanie
        $_SESSION['zarejestrowano'] = true;

        // Wyczyść dane z sesji
        unset($_SESSION['login']);
        unset($_SESSION['email']);

        // Przekieruj na stronę rejestracji
        header('Location: ../rejestracja.php');
        exit();
    }
}
?>
