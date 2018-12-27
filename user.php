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
    <a href="#"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="#"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
  <div style="clear:both"></div>

    <?php
      $suprise=$_SESSION['ln'];
      $nam = $_SESSION['name'];
      $lnam = $_SESSION['last_name'];
      $lgin = $_SESSION['login'];
      $watched = $_SESSION['movies_watched'];
      $spent = $_SESSION['time_spent'];


echo<<<END
<div class="avatar">
 <img src='style/img/avatars/$suprise.jpg' style='width: 200px; height: 200px;' />
</div>
<div class="info">
  <div class ="uper">
  <h1>Witaj $nam $lnam</h1></div>
  <span>$lgin</span>

  <ul>
    <li><p>Liczba ocenionych filmów: $watched </li>
    <li><p>Czas spędzony na oglądaniu filmów: $spent </li>
  </ul>
  </div>
END
?>

  </div>
</div>


</body>
</html>
