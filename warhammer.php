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

<div class="container">
   <div class="header">
      <h1>Co to Warhammer 40k?</h1>
   </div>

   <div class="tekst">
      <p>Niektóre osoby, zwłaszcza młodsze, mogą Warhammera kojarzyć z grami komputerowymi lub ekranizacją, która jakiś czas temu pojawiła się w kinach. Jednakże jego historia sięga lat osiemdziesiątych, gdzie powstał jako gra bitewna rozgrywana przy pomocy miniaturowych armii. Od tamtej pory uniwersum Warhammera rozrosło się do niebagatelnych rozmiarów i na całym świecie zdobyło miliony fanów.</p>
   </div>

   <div class="opis">
      <h2>Uniwersum Warhammera – 40 000 lat ludzkości</h2>
      <p>Samo uniwersum Warhammera (świat, w którym dzieje się akcja) jest bardzo rozbudowane, dzieli się też na mniejsze settingi, które dzielą je na mniejsze elementy. Warhammer jest osadzone w świecie fantastycznym, którego początek zaczyna się w cywilizacji Slann, która dała początek istnieniu większości ras inteligentnych, takich jak ludzie. Następnie świat dzieli się na Warhammer 40000 (40K) oraz Warhammer Fantasy Battle (WFB), który od 2015 roku przekształcił się w Warhammer Age od Sigmar (AoS). Można powiedzieć, że światy te dzieją się w jednym świecie, ale w dwóch przedziałach czasowych. Pierwszy, czyli WFB dzieje się w świecie inspirowanym renesansem i jest oparty o klasyczny świat fantasy, poza ludźmi występują w nim istoty fantastyczne takie jak: elfy, krasnoludy, niziołki czy gryfy i zwierzoludzie. Natomiast drugi świat – Warhammer 40k – dzieje się czterdzieści tysięcy lat później, kiedy ludzkie Imperium przekształca się w międzyplanetarną jednostkę, a technika przenosi się w świat science-fiction.</p>
   </div>
   <div class="opis">

<div class="image-container">
   <img src="images/war1.jpg" alt="war" class="war-image">
</div>
</div>
   <div class="opis">
      <h2>Warhammer – zasady gry</h2>
      <p>ak każda gra, Warhammer ma swoje zasady gry. Jest to gra bitewna, polegająca na toczeniu potyczek za pomocą miniaturowych figur, które symbolizują poszczególne frakcje armii. Dwoje lub więcej przeciwników rozkłada się na odpowiednio przygotowanym polu bitwy, a następnie podczas czterech faz ruchu przeprowadza swoje działania wojenne – zadaniem graczy jest zwyciężenie bitwy. W zależności od edycji i settingu szczegółowe zasady różnią się między sobą, są też na tyle rozbudowane, że nie będziemy ich przytaczać. Można się z nimi zapoznać w specjalnych podręcznikach, takich jak Warhammer 40000: CORE BOOK lub Warhammer Age of Sigmar Core Book.</p>
   </div>

   <div class="opis">
      <h2>Jak zacząć grać w Warhammera?</h2>
      <p>Aby rozpocząć swoją przygodę z Warhammerem, najpierw musisz wybrać setting (czyli czas, w którym będą rozgrywać się bitwy). Możesz wybrać AoS, czyli świat fantasy lub 40k, czyli świat science fiction, dziejący się w kosmosie. Następnie powinieneś przejrzeć dostępne frakcje. Każda z nich bowiem ma inne zasady oraz jednostki, niektóre używają specyficznego sprzętu, inne magii. Jednakże wśród miłośników Warhammera krąży jedna, niepisana, acz zapisana zasada: „wybierz armię, która najbardziej podoba Ci się wizualnie”. Przez większość czasu bowiem Warhammer skupia się na zbieraniu i malowaniu figurek, które jeśli nam się nie podobają wizualnie, szybko się znudzą.</p>
   </div>
   <div class="image-container">
   <img src="images/war2.jpg" alt="war" class="war-image">
</div>
   <div class="opis">
      <h2>Czym różni się Coxdex od Battletome?</h2>
      <p>Każda armia posiada swoją Księgę Armii, czyli Codex/Battletome, w której opisana jest jej historia oraz ekwipunek. Tutaj znajdziesz wszelkie statystyki dotyczące jednostki, a także ich umiejętności specjalne. Dowiesz się także wszystkiego o poszczególnych figurkach oraz znajdziesz ciekawe i przydatne informacje na temat ich malowania. Jeśli zastanawiasz się, czym różni się Codex od Battletome, to te pierwsze opisują armie Warhammer 40K, a te drugie Warhammer AoS.</p>
   </div>

   <div class="opis">
      <h2>Warhammer – jak zacząć: kup starter</h2>
      <p>Po wybraniu opcji, która będzie Ci najbardziej odpowiadać najlepiej zakupić tak zwany starter, w którym będą figurki oraz podręczniki z zasadami gry, oraz ze scenariuszami do rozegrania. W zależności od settingu możesz zdecydować się na Getting Started With Warhammer Age of Sigmar lub Getting Started With Warhammer 40K, które są wprowadzeniem do gry. Możesz także od razu zakupić pełen starter, który zawiera główny podręcznik danego settingu oraz początki dwóch armii, a także inne przydatne załączniki. Możesz wybrać na przykład: AGE OF SIGMAR: DOMINION lub Warhammer 40K COMMAND EDITION.</p>
   </div>

   <div class="opis">
      <h2>Inne niezbędne akcesoria</h2>
      <p>Gra opiera się o rozegranie bitwy na danym terenie, której tło opisywane jest w podręczniku. Aby rozegrać samą bitwę oprócz armii i zasad potrzebujesz także dodatkowych akcesoriów. Do tych podstawowych i niezbędnych należą: Workshop Tape Measure, czyli taśma miernicza do odmierzania odległości między jednostkami oraz przesuwania jednostek, oraz kości do gry (zwane K6 lub D6). Można wybrać zwykłe Kości Warhammer bez frakcyjnych oznaczeń lub kości dedykowane dla danej frakcji jak Warhammer AoS Grand Alliance ORDER Dice set.</p>
   </div>
   <div class="opis">
      <h2>Mam już wszystko i co dalej?</h2>
      <p>Teraz czas na rozgrywkę, możesz ją rozegrać w domu z przyjaciółmi lub wybrać się do lokalnego klubu, który organizuje bitwy między swoimi członkami. I o ile na początku możesz gry rozgrywać ją po prostu na stole lub podłodze, to z czasem warto zainwestować w plansze do gier oraz elementy scenerii, które wprowadzą dodatkowy klimat do gry. Jednym z ciekawszych jest Warhammer AoS Realm of Battle: Blasted Hallowheart, który można łatwo złożyć i zabrać ze sobą na rozgrywkę. Poza tym czeka Cię zbieranie kolejnych figurek, z których będziesz mógł skompletować całą armię oraz dodatkowe elementy scenerii. Niezbędne będą też farby do figurek oraz pędzle do malowania, ponieważ figurki należy pomalować samemu.</p>
   </div>
   <div class="footer">
      źródło https://militarialodz.pl
   </div>
</div>

   


<?php include('html/footer.php'); ?>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>