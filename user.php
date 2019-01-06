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
  <link rel="stylesheet" href="style/style_user.css" type="text/css">
  <?php
  echo "<title>".$_SESSION['login']. "</title>";
  ?>

</head>
<body>
  <div id="container">
  <div id="main">
  <div class="tyt">
    <a class="active" href="index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?php
      $supr = $_SESSION['ln'];
      $imie= $_SESSION['name'];
      $nazwisko = $_SESSION['last_name'];
      echo "<div id='login_name'><a href='user.php'><img class='avatar' src="."'style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
      echo "<div id='how'>";
      echo '<ul> <li><a href="logout.php">wyloguj sie</a></li></ul></div></div>';

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
  <div style="clear:both"></div>

    <?php

      require_once 'connect.php';

      $suprise=$_SESSION['ln'];
      $nam = $_SESSION['name'];
      $lnam = $_SESSION['last_name'];
      $lgin = $_SESSION['login'];

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    $conn->set_charset("utf8");

    $liczba_ocen=1500;
    $czas =112;

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

      if($rezultat =@$conn->query("SELECT * FROM users where login='$lgin'") ){
        if($rezultat->num_rows>0){
          $wiersz = $rezultat->fetch_assoc();
          $liczba_ocen = $wiersz['movies_watched'];
          $czas = $wiersz['time_spent'];

        }
        $rezultat->free_result();
    }


echo<<<END
<div id="avatar">
 <img src='style/img/avatars/$suprise.jpg' style='width: 200px; height: 200px;' />
</div>
<div class="info">
  <div class ="uper">
  <h1>Witaj $nam $lnam</h1></div>
  <span>$lgin</span>

  <ul id="tenul">
    <li><p>Liczba ocenionych filmów: $liczba_ocen </li>
    <li><p>Twój czas spędzony na oglądaniu filmów to : $czas minut</li>
  </ul>
  </div>
END
?>

  </div>
</div>


</body>
</html>
