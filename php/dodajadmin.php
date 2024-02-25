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
    $_SESSION['dodanie'] = "Error: " . $polaczenie->connect_errno;
    exit();
}

// Sprawdź, czy administrator jest zalogowany
if (!isset($_SESSION['admin'])) {
    // Jeśli administrator niezalogowany, ustaw komunikat w sesji i przekieruj do strony logowania admina
    $_SESSION['dodanie'] = '<span style="color:red">Administrator niezalogowany!</span>';
    header("Location: ../admin.php");
    exit();
}

// Sprawdź, czy przesłano dane POST i czy przycisk "dodaj" został naciśnięty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dodaj'])) {
    // Pobierz dane z formularza
    $nazwa_jednostki = $_POST['nazwa_jednostki'];
    $frakcja = $_POST['frakcja'];
    $ilosc_modeli = $_POST['ilosc_modeli'];
    $koszt_punktow = $_POST['koszt_punktow'];

    // Przygotuj zapytanie dodające jednostkę do bazy danych
    $stmt = $polaczenie->prepare("INSERT INTO jednostki (nazwa_jednostki, frakcja, ilosc_modeli, koszt_punktow) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nazwa_jednostki, $frakcja, $ilosc_modeli, $koszt_punktow);

    // Wykonaj zapytanie i sprawdź, czy dodanie zakończyło się sukcesem
    if ($stmt->execute()) {
        $_SESSION['dodanie'] = "Jednostka dodana pomyślnie.";
    } else {
        // Jeśli błąd, ustaw komunikat błędu w sesji
        $_SESSION['dodanie'] = "Błąd podczas dodawania jednostki: " . $stmt->error;
    }

    // Zamknij przygotowane zapytanie
    $stmt->close();
}

// Zamknij połączenie z bazą danych
$polaczenie->close();

// Ustaw flagę oznaczającą poprawne dodanie
$_SESSION['dodane'] = true;

// Pobierz adres URL poprzedniej strony (referer) lub ustaw domyślną stronę admina
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'adminedit.php';

// Przekieruj na poprzednią stronę
header("Location: $referer");
exit();
?>
