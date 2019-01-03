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

  <title>MovieLovie</title>
</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?php
    if(isset($_SESSION['zalogowany'])){
      $supr = $_SESSION['ln'];
      $imie= $_SESSION['name'];
      $nazwisko = $_SESSION['last_name'];
      echo "<div id='login_name'><a href='user.php'><img class='avatar' src="."'style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
      echo "<div id='how'>";
      echo '<ul> <li><a href="logout.php">wyloguj sie</a></li></ul></div></div>';

    }
    else{
    echo '<a href="register.php"><div class="log-btn">zarejstruj sie</div></a>';
    echo '<a href="login.php"><div class="log-btn">zaloguj sie</div></a>';
   }
     ?>

    <div style="clear:both"></div>
    <div id="button-bar">
    <a href="movies.php"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="articles.php"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed">
      <h2>newsy</h2>
      <article>
        <p>Jay i Cichy Bob w drodze na ekran
         <img src="style/img/jay.jpg" alt="Jay and silent Bob" height="auto" width="620"> </p>

        <p>Gary Oldman chce znów zagrać Churchilla</br>
        <img src="style/img/oldman.jpg" alt="Gary Oldman" height="auto" width="620"> </p>

        <p>"Aquaman" największym hitem w historii DCEU poza granicami USA
        <img src="style/img/kasa.jpg" alt="kasa" height="auto" width="620"></p>

        <p>Kevin Spacey usłyszał zarzuty. W odpowiedzi opublikował wideo</br>
        <img src="style/img/ks.jpg" alt="kevin spacey" height="auto" width="620"></p>

        <h2>zwiastuny</h2>

         <p>Czarne lustro: Bandersnatch</br>
         <iframe width="620" height="360" src="https://www.youtube.com/embed/hVWSqUHQwF4"></iframe></p>

         <p>Godzilla II: Król potworów</br>
         <iframe width="620" height="360" src="https://www.youtube.com/embed/KDnKuFtdc7A"></iframe></p>
         <p>Men in Black: International</br>
         <iframe width="620" height="360" src="https://www.youtube.com/embed/qvXzEhXujxA"></iframe></p>
         <p>Us</br>
         <iframe width="620" height="360" src="https://www.youtube.com/embed/hNCmb-4oXJA"></iframe></p>


         <h2>dobre filmy</h2>
         <div class="filmy">
           <p class="film"><a class="movi" href="movies/3.php">Cloverfield Lane 10</a></p>
           <p class="film"><a class="movi" href="movies/1.php">Zombiland</a></p>
           <p class="film"><a class="movi" href="movies/2.php">Ciche mjejsce</a></p>
         </div>


      </article>
    </div>
    </div>
  </div>

  <script>
  /*
  document.querySelector('.login_name').onmouseover = function(){
    document.querySelector('.hower').style.display = 'block';
  }
  document.querySelector('.login_name').onmouseout = function(){
    document.querySelector('.hower').style.display = 'none';
  }*/

  </script>

</body>
</html>
