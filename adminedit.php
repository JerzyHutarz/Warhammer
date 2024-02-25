<?php
// Start sesji
session_start();

// Sprawdź, czy użytkownik jest zalogowany jako administrator
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit();
}

// Wymagaj pliku connect.php
require "php/connect.php";

// Połącz z bazą danych
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

// Określ kolumnę i kolejność sortowania dla zapytania SQL
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'nazwa_jednostki';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Zmienna przechowująca komunikat o dodaniu jednostki
$dodaneMessage = "";

// Wyświetl komunikat o dodaniu jednostki, jeśli istnieje
if (isset($_SESSION['dodane']) && $_SESSION['dodane']) {
    $dodaneMessage = "Jednostka dodana!";
    unset($_SESSION['dodane']);
}

// Zmienna przechowująca komunikat o usunięciu jednostki
$usunMessage = "";

// Wyświetl komunikat o usunięciu jednostki, jeśli istnieje
if (isset($_SESSION['usuniecie']) && $_SESSION['usuniecie']) {
    $usunMessage = "Jednostka usunięta!";
    unset($_SESSION['usuniecie']);
}

// Pobierz dane z bazy danych, posortowane zgodnie z zadanymi kolumną i kolejnością
$result = $polaczenie->query("SELECT * FROM jednostki ORDER BY $sortColumn $sortOrder");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Strona główna</title>
    <!-- Dodanie własnych stylów -->

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   


<?php include('html/header.php'); ?>
<!-- Sekcja dodawania jednostek -->

<div class="dodaj">
    <h2>Edytuj listę jednostek</h2>

        <!-- Wyświetlanie komunikatu o dodaniu jednostki-->

    <?php if (!empty($dodaneMessage)) : ?>
        <div class="error">
            <p><?php echo $dodaneMessage; ?></p>
        </div>
    <?php endif; ?>

        <!-- Wyświetlanie komunikatu o usunięciu jednostki-->

    <?php if (!empty($usunMessage)) : ?>
        <div class="error">
            <p><?php echo $usunMessage; ?></p>
        </div>
    <?php endif; ?>

        <!-- Formularz dodawania jednostki -->

    <form action="php/dodajadmin.php" method="post" class="form">
        <label for="nazwa_jednostki" class="label">Nazwa Jednostki:</label>
        <input type="text" name="nazwa_jednostki" class="input" required>

        <label for="frakcja" class="label">Frakcja:</label>
        <select name="frakcja" class="select" required>
            <option value="Demony">Demony</option>
            <option value="Eldarzy">Eldarzy</option>
            <option value="Heretycy">Heretycy</option>
            <option value="Imperium">Imperium</option>
            <option value="Mechanicus">Mechanicus</option>
            <option value="Nekroni">Nekroni</option>
            <option value="Orkowie">Orkowie</option>
            <option value="Space Marine">Space Marine</option>
            <option value="Tau">Tau</option>
            <option value="Tyranidzi">Tyranidzi</option>
        </select>

        <label for="ilosc_modeli" class="label">Ilość Modeli:</label>
        <input type="number" name="ilosc_modeli" class="input" required>

        <label for="koszt_punktow" class="label">Koszt Punktów:</label>
        <input type="number" name="koszt_punktow" class="input" required>

        <button class="btn" type="submit" name="dodaj">Dodaj Jednostkę</button>
    </form>
</div>

<!-- Sekcja listy jednostek -->

<div class="jednostki-lista">
<br>
<br>

    <h2>Lista jednostek </h2>
        <!-- Lista jednostek i przycisk usuwania -->

    <form action="php/usunadmin.php" method="post">
        <table class="table-style">
            <tr>
                                <!-- Kolumny tabeli z możliwością sortowania -->

                <th class="table-cell">Nazwa Jednostki <a href="?sort=nazwa_jednostki&order=<?php echo $sortColumn == 'nazwa_jednostki' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                <th class="table-cell">Frakcja <a href="?sort=frakcja&order=<?php echo $sortColumn == 'frakcja' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                <th class="table-cell">Ilość Modeli <a href="?sort=ilosc_modeli&order=<?php echo $sortColumn == 'ilosc_modeli' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                <th class="table-cell">Koszt Punktów <a href="?sort=koszt_punktow&order=<?php echo $sortColumn == 'koszt_punktow' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                <th class="table-cell">Akcje</th>
            </tr>
            <?php
                        // Wyświetl dane jednostek w tabeli

            while ($row = $result->fetch_assoc()) {
                echo "<tr class='table-row'>";
                echo "<td class='table-cell'>" . $row['nazwa_jednostki'] . "</td>";
                echo "<td class='table-cell'>" . $row['frakcja'] . "</td>";
                echo "<td class='table-cell'>" . $row['ilosc_modeli'] . "</td>";
                echo "<td class='table-cell'>" . $row['koszt_punktow'] . "</td>";
                echo "<td class='table-cell'><button class='btn button' type='submit' name='usun' value='" . $row['nazwa_jednostki'] . "'>Usuń</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</div>






            

<?php include('html/footer.php'); ?>


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


<script src="../js/script.js"></script>

</body>
</html>