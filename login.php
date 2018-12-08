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
<div class="box">
    <div class="login">
    <form action="zaloguj.php" method="post">
      <h1 class="hhh">Zaloguj się</h2>
      <input class="inp" type="text" name="Login" placeholder="login" /> </br/></br/>
      <input class="inp" type="password" name="Hasło" placeholder="hasło" />
      <br /><br />
      <input class="btn" type="submit" value="Zaloguj się"></br/>

    </form>
    </div>
    </div>
  </div>
  </div>

</body>
</html>
