<?php
session_start();

require_once '../connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    $mainid=$iidd;

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      $query4="SELECT * FROM articles where id =$mainid";
      if($rezultat4 =@$polaczenie->query($query4) ){
        if($rezultat4->num_rows>0){

        $wiersz = $rezultat4->fetch_assoc();

          $aname =$imie;
          $alastname =$nazwisko;

          $idd = $iidd;
          $tytul = $tyt;
          $tresc = $artykul;
          
          $zddj = $fileNameNew;


        }else{echo "<script type='text/javascript'>alert('niepyklo');</script>";}
        $rezultat4->free_result();
      }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}

        $polaczenie->close();
        }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../style/pasek.css" type="text/css">
  <link rel="stylesheet" href="../style/style.css" type="text/css">
  <style media="screen">
  #main2{
    box-shadow: -10px 0 10px -10px #333, 10px 0 10px -10px #333;
    width: 88%;
    margin-top: 0px;
    padding-top: 0px;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
    background-color:  #C8C8C8;
  }
  </style>

  <title>MovieLovie</title>
</head>
<body>
  <div id="container">
  <div id="main2">
  <div class="tyt">
    <a class="active" href="../index.php">MovieLovie.com</a>
    <input class="sb" type="text" placeholder="Szukaj...">
    <?phpif(isset($_SESSION[zalogowany])){$supr = $_SESSION[ln];$imie= $_SESSION[name];$nazwisko = $_SESSION[last_name];
      echo "<div id='login_name'><a href='../user.php'><img class='avatar' src="."'../style/img/avatars/$supr.jpg'"." height='50' width='50'>ELO $imie $nazwisko</a>";
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
    <a href="../movies.php"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="../articles"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed">

<?php
ECHO<<<END
<h2 class="tyt-newsa">$tyt</h2>
<article>
  <p class ="autor"><i>Autor: $imie $nazwisko</i></p>
  <p>$artykul</p>
  <img src="../style/img/$fileNameNew" alt="" height="auto" width="620"></p></a>

 ?>
      </article>
    </div>
    </div>
  </div>


</body>
</html>
