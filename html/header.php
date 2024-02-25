<!-- Sekcja nagłówka -->
<section class="header">

   <!-- Link do strony głównej -->
   <a href="home.php" class="logo">
      <?php
      // Sprawdź aktualny URL, aby ustalić, jaki tekst wyświetlić
      if (strpos($_SERVER['REQUEST_URI'], 'home.php') !== false) {
         echo 'Kalkulator siły wojska';
      } else {
         echo 'Strona główna';
      }
      ?>
   </a>

   <!-- Nawigacja -->
   <nav class="navbar">

      <?php
      // Sprawdź, czy użytkownik jest zalogowany
      if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
         // Wyświetl linki dla zalogowanego użytkownika
         echo '<a href="edycja_jednostek.php">Moja armia</a>';
         echo '<a href="php/wylogowanie.php">Wyloguj (' . $_SESSION['nazwa_uzytkownika'] . ')</a>';
      } else {
         // Sprawdź, czy użytkownik jest administratorem
         if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            // Wyświetl linki dla administratora
            echo '<a href="adminedit.php">Edytuj listę jednostek</a>';
            echo '<a href="php/wylogowanie.php">Wyloguj</a>';
         } else {
            // Wyświetl linki dla niezalogowanego użytkownika
            echo '<a href="logowanie.php">Logowanie</a>';
            echo '<a href="rejestracja.php">Rejestracja</a>';
         }
      }
      ?>
   </nav>

   <!-- Przycisk menu dla responsywnej nawigacji mobilnej-->
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
