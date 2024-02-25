<?php
// Rozpocznij sesję, aby obsługiwać sesje użytkownika
session_start();

// Sprawdź, czy użytkownik jest już zalogowany i przekieruj go do strony Edycja_jednostek.php
if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
{
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

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('html/header.php'); ?>

<section class="logowanie">
   <h1 class="heading-title">Login</h1>

   <?php
   // Wyświetl komunikaty o błędach lub dodaniu
   if(isset($_SESSION['dodanie'])) echo $_SESSION['dodanie'];
   unset($_SESSION['dodanie']);
   if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
   unset($_SESSION['blad']);
   ?>

   <form action="php/zaloguj.php" method="post" class="logowanie">
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

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="../js/script.js"></script>

</body>
</html>
