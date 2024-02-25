<?php
session_start();

require "php/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno) {
    echo "Error: " . $polaczenie->connect_errno;
}

$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'nazwa_jednostki';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

$dodaneMessage = "";


if (isset($_SESSION['dodane']) && $_SESSION['dodane']) {
    $dodaneMessage = "Jednostka dodana!";
    unset($_SESSION['dodane']);
} elseif (isset($_SESSION['zlafrakcja']) && $_SESSION['zlafrakcja']) {
    $dodaneMessage = "Frakcja jednostki nie pasuje do frakcji armii.";
    unset($_SESSION['zlafrakcja']);
}


$result = $polaczenie->query("SELECT * FROM jednostki WHERE frakcja = 'Imperium' ORDER BY $sortColumn $sortOrder");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/tabela.js" defer></script>
    <script>
        <?php
        if (isset($_SESSION['zarejestrowano']) && $_SESSION['zarejestrowano']) {
            echo 'document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("gratulacje-popup").style.display = "block";
            });';
            unset($_SESSION['zarejestrowano']);
        }
        ?>
    </script>
</head>

<body>
    <?php include('html/header.php'); ?>

    <div class="jednostki-lista">
        <h2>Lista jednostek (Imperium)</h2>
        <?php if (!empty($dodaneMessage)) : ?>
            <div class="error">
                <p><?php echo $dodaneMessage; ?></p>
            </div>
        <?php endif; ?>
        <form action="php/dodaj.php" method="post">
            <table class="table-style">
                <tr>
                    <th class="table-cell">Nazwa Jednostki <a href="?sort=nazwa_jednostki&order=<?php echo $sortColumn == 'nazwa_jednostki' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                    <th class="table-cell">Frakcja <a href="?sort=frakcja&order=<?php echo $sortColumn == 'frakcja' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                    <th class="table-cell">Ilość Modeli <a href="?sort=ilosc_modeli&order=<?php echo $sortColumn == 'ilosc_modeli' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                    <th class="table-cell">Koszt Punktów <a href="?sort=koszt_punktow&order=<?php echo $sortColumn == 'koszt_punktow' && $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">↑↓</a></th>
                    <th class="table-cell">Akcje</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='table-row'>";
                    echo "<td class='table-cell'>" . $row['nazwa_jednostki'] . "</td>";
                    echo "<td class='table-cell'>" . $row['frakcja'] . "</td>";
                    echo "<td class='table-cell'>" . $row['ilosc_modeli'] . "</td>";
                    echo "<td class='table-cell'>" . $row['koszt_punktow'] . "</td>";
                    echo "<td class='table-cell'><button class='btn' type='submit' name='dodaj' value='" . $row['id'] . "'>Dodaj</button></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </div>
    </div>
    <div class="opis">
      <h2>Czym Imperium jest w świecie Warhammer 40k?</h2>
      <p>Imperium to megapaństwo obejmujące miliony planet. Jego sercem jest nasza ziemia w odległej przyszłości czterdziestego milenium. Po tysiącach lat wzlotów i upadków, pokoju i, znacznie cześciej, wojen ziemia została zjednoczona pod władzą Imperatora Ludzkości. Chociaż ten już jest zaledwie podtrzymywanymi przy życiu zwłokami ludzkość wciąż jest wierna jemu i jego, szalenie wypaczonym przez jego spadkobierców, ideałom. Główną siłą walczącą w Imperium i podlegającą władzom Terry, jak w czterdziestym milenium nazywa się ziemię, jet Gwardia Imperialna.</p>
   </div>
   <div class="image-container">
   <img src="images/imperator.jpg" alt="war" class="war-image">
</div>
    <?php include('html/rasy.php'); ?>

    <?php include('html/footer.php'); ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

</body>

</html>


