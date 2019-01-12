<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style/style_login.css" type="text/css">
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <title>Logowanie</title>
  <style>
  .error
  {
    height: 15px;
      color:#980000 ;
      font-size: 13px;
      margin-top: 0px;
      margin-bottom: 2px;
  }
  </style>
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
      echo "<div id='login_name'><a href='user.php'><img class='avatar' src="."'../style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
      echo "<div id='how'>";
      echo '<ul> <li><a href="../logout.php">wyloguj sie</a></li></ul></div></div>';

    }
    else{
    echo '<a href="../register.php"><div class="log-btn">zarejstruj sie</div></a>';
    echo '<a href="../login.php"><div class="log-btn">zaloguj sie</div></a>';
   }
     ?>
    <div style="clear:both"></div>
    <div id="button-bar">
      <a href="movies.php"><div class="top-btn">Filmy</div></a>
      <a href="series.php"><div class="top-btn">Seriale</div></a>
      <a href="artists.php"><div class="top-btn">Ludzie kina</div></a>
      <a href="articles.php"><div class="top-btn">Newsy</div></a>
      <a href="reviews.php"><div class="top-btn">Recenzje</div></a>
      <a href="trailers.php"><div class="top-btn">Zwiastuny</div></a>
    </div>
  </div>
<div class="box">
    <div class="login">
    <form action="zaloguj.php" method="post">
      <h1 class="hhh">Zaloguj się</h2>
      <input class="inp" type="text" name="Login" placeholder="login" /> </br/></br/>
      <input class="inp" type="password" name="Hasło" placeholder="hasło" />
      <?php
        if(isset($_SESSION['blad'])) {
          echo $_SESSION['blad'];
          unset($_SESSION['blad']);
        }
       ?>
      <br /><br />
      <input class="btn" type="submit" value="Zaloguj się"></br/>

    </form>
    </div>
    </div>
  </div>
  </div>

</body>
</html>
