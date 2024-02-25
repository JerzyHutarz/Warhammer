<?php
// Rozpocznij sesję, aby obsługiwać sesje użytkownika
session_start();

// Sprawdź, czy użytkownik jest zalogowany
if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany'] == true)) {
    // Jeśli tak, przekieruj na stronę edycji jednostek
    header('Location: edycja_jednostek.php');
    exit();
}
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
    <script>
        <?php
        // Wyświetl popup z gratulacjami po udanej rejestracji
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

    <section class="logowanie">
        <h1 class="heading-title">Rejestracja</h1>

        <form action="php/rejestruj.php" method="post" class="rejestracja">

            <div class="flex">
                <div class="inputBox">
                    <span>Login</span>
                    <input type="text" placeholder="Wpisz login" name="login" value="<?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : ''; ?>">
                </div>
                <?php
                if (isset($_SESSION['blad']) && strpos($_SESSION['blad'], 'Login') !== false) {
                    echo '<div class="errorlogin">' . $_SESSION['blad'] . '</div>';
                    unset($_SESSION['blad']);
                }
                ?>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>Email</span>
                    <input type="email" placeholder="Wpisz email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
                </div>
                <?php
                if (isset($_SESSION['blad']) && strpos($_SESSION['blad'], 'Email') !== false) {
                    echo '<div class="errorlogin">' . $_SESSION['blad'] . '</div>';
                    unset($_SESSION['blad']);
                }
                ?>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>Hasło</span>
                    <input type="password" placeholder="Wpisz hasło" name="haslo">
                </div>
                <?php
                if (isset($_SESSION['blad']) && strpos($_SESSION['blad'], 'Hasło') !== false) {
                    echo '<div class="errorlogin">' . $_SESSION['blad'] . '</div>';
                }
                ?>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>Powtórz hasło</span>
                    <input type="password" placeholder="Powtórz hasło" name="powtorz_haslo">
                </div>
                <?php
                if (isset($_SESSION['blad'])) {
                    echo '<div class="errorlogin">' . $_SESSION['blad'] . '</div>';
                    unset($_SESSION['blad']);
                }
                ?>
            </div>

            <div class="inputBox checkBox">
                <input type="checkbox" id="regulamin" name="regulamin" required>
                <label for="regulamin">
                    Akceptuję<a href="regulamin.php"> regulamin</a>
                </label>
            </div>

            <?php
            if (isset($_SESSION['blad']) && strpos($_SESSION['blad'], 'Akceptuj regulamin') !== false) {
                echo '<div class="errorlogin">' . $_SESSION['blad'] . '</div>';
                unset($_SESSION['blad']);
            }
            ?>

            <input type="submit" value="Zarejestruj się" class="btn" name="send">
        </form>
    </section>

    <?php include('html/rasy.php'); ?>
    <?php include('html/footer.php'); ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <div id="gratulacje-popup" style="display: none; background-color: #fff; padding: 20px; border: 3px solid #000; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;width: auto;
        max-width: 600px; height: auto;
        max-height: 3000px; ">
        <p style="font-size: 25px;">Gratulacje, rejestracja przebiegła pomyślnie!</p>
        <a href="logowanie.php" style="font-size: 15px;">Przejdź do logowania</a>
    </div>
</body>

</html>
