<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">

  <title>Document</title>
</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Search..">
    <a href="register.php"><div class="log-btn">zarejstruj sie</div></a>
    <a href="login.php"><div class="log-btn">zaloguj sie</div></a>
    <div style="clear:both"></div>
    <div id="button-bar">
    <a href="#"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="#"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed">
      <h2>newsy</h2>
      <article>
        <p>Znamy tytuł nowej części Avengers</br>
        <iframe width="620" height="360" src="https://www.youtube.com/embed/hA6hldpSTF8"></iframe></p>

        <p>Polscy "Szybcy i wściekli"? Raczej szybcy i biedni xd</br>
        <iframe width="620" height="360" src="https://www.youtube.com/embed/mel7Kh4k_mo"></iframe></p>

        <p>Już niedługo ruszają zdjęcia do kolejnego "Jaya i Cichego Boba"
         <img src="style/img/jay.jpg" alt="Jay and silent Bob" height="auto" width="620"> </p>

         <p>Nowy zwiastun Kapitan Marwel</br>
         <iframe width="620" height="360" src="https://www.youtube.com/embed/0LHxvxdRnYc"></iframe></p>
        <p>Kevin Hart jednak nie zostanie gospodarzem Oscarów 2019
        <img src="style/img/hrt.jpg" alt="Kevin Hart" height="auto" width="620"></p>
        <p>ZŁOTE GLOBY 2019: Bez nominacji dla "Zimnej wojny"
        <img src="style/img/glob.jpg" alt="golden globes" height="auto" width="620"></p>
         <h2>dobre filmy</h2>
         <p class="film"><a href="movies/3.php">Cloverfield Lane 10</a></p>
         <p class="film"><a href="movies/1.php">Zombiland</a></p>
         <p class="film"><a href="movies/2.php">ciche mjejsce</a></p>
      </article>
    </div>
    </div>
  </div>

  <?php

   ?>
</body>
</html>
