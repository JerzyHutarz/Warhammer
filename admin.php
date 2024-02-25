<?php
// Rozpocznij sesję
session_start();

// Sprawdź, czy zalogowany użytkownik jest administratorem
if(isset($_SESSION['admin']) && ($_SESSION['admin']==true))
{
   // Jeśli tak, przekieruj go do panelu administracyjnego i zakończ skrypt
   header('Location: adminedit.php');
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

   <!-- Dodaj link do własnego arkusza stylów CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include('html/header.php'); ?>

<section class="logowanie">
    <?php
    // Wyświetl komunikaty, jeśli są ustawione w sesji, a następnie usuń je
    if(isset($_SESSION['dodanie'])) echo $_SESSION['dodanie'];
    unset($_SESSION['dodanie']);
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
    unset($_SESSION['blad']);
    ?>
    <h1 class="heading-title">Panel Admina</h1>

    <!-- Formularz logowania -->
    <form action="php/adminlogin.php" method="post" class="logowanie">
        <div class="flex">
            <div class="inputBox">
                <span>Login</span>
                <input type="text" placeholder="wpisz login" name="login">
            </div>
            <div class="inputBox">
                <span>Hasło:</span>
                <input type="password" placeholder="wpisz hasło" name="haslo">
            </div>
        </div>
        <input type="submit" value="Zaloguj się" class="btn" name="send">
    </form>

  

</section>

<?php include('html/footer.php'); ?>

</body>
</html>
