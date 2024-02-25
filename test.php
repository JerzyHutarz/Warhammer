<?php
session_start();

require "php/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno) {
    echo "Error: " . $polaczenie->connect_errno;
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


<div class="tekst">
      <h2>Jaki paciur jest...</h2>
      <p>...każdy widzi</p>
      <div>
   <img src="images/paciur.gif" alt="Jerzy Hutarz" class="profile-image">
</div>
   </div>


<?php include('html/footer.php'); ?>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>