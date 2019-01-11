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
  <style>
  #maina{
    box-shadow: -10px 0 10px -10px #333, 10px 0 10px -10px #333;
    width: 88%;
    margin-top: 0px;
    padding-top: 0px;
     min-height: 620px;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
    background-color:  #C8C8C8;
  }
  .newsfeed2{
    width: 900px;
    margin-left: 25px;
  }
    .film-div{
      margin-top: 10px;
      border-radius: 12px;
      height: 130px;
      width:100%;
      margin-left: 0px;
      margin-right: 0px;
      background-color:#D9D9D9;
    }
    .film-div:hover{
      transform: scale(1.08);
      transition: .3s;
    }
    .mini-poster{
      float: left;
    }
    .mini-info-box{
      margin-left: 230px;
    }
    .iii{
      font-size: 19px;
    }
    .tit{
      font-size: 27px;
    }
    #srd{
      margin-bottom: 20px;
        font-size: 25px;
      margin-left: 510px;
      color: 	#B8860B;
    }
    ul{
      list-style: none;
    }

a.nv, a.nv:visited, a.nv:hover, a.nv:active{
   text-decoration: none;
   color: #100000
}
.artik, .artik:visited, .artik:active{
   text-decoration: none;
   color: #100000;
}
 a.artik:hover{

  text-decoration: underline;
  color: #000000;
}
  </style>


  <?php
  echo "<title>".$_SESSION['login']. "</title>";
  ?>

</head>
<body>
  <div id="container">
  <div id="maina">
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
      $filmys="";
      $reviews="";

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

    if($rezultat4 =@$conn->query("SELECT * FROM `movies` where movie_title in (SELECT title from movies_rated WHERE login = '$lgin')") ){
      if($rezultat4->num_rows>0){

      $i=0;
      while($wiersz = $rezultat4->fetch_assoc()){

        $idd[$i] = $wiersz['id'];
        $tytul[$i]=$wiersz['movie_title'];
        $dlugosc[$i] = $wiersz['runtime'];
        $data[$i]= $wiersz['release_date'];
        $date[$i] = DateTime::createFromFormat("Y-m-d", $data[$i]);
        $d[$i] = $date[$i]->format("Y");

        $i=$i+1;
      }

      for ($x = 0; $x < $i; $x++) {
        if($rezultat6 =@$conn->query("SELECT grade FROM movies_rated WHERE title='$tytul[$x]' and login = '$lgin'") ){
          if($rezultat6->num_rows>0){

          $wiersz6 = $rezultat6->fetch_assoc();
          $twoja = $wiersz6['grade'];
          //$ocenaa = "Film oceniono na $ocenka / 5";
          $filmys .= "<li><a class='nv' href='movies/$idd[$x].php'><div class='film-div'><div class='mini-poster'><img src='style/img/$idd[$x].jpg' alt='movie poster' style='width: 90px; height: 130px;'></div><div class='mini-info-box'><h3 class='tit'>$tytul[$x] ($d[$x])</h3> <i class='iii'>$dlugosc[$x] min</i></div> <span id='srd'>Twoja ocena: $twoja </span></div></a></li>";

          }else{
          //  $ocenaa ="Nie oceniono tego filmu";
          }
          $rezultat6->free_result();
        }else{

        }

     }

      }else{}
      $rezultat4->free_result();
    }else{}

      if($rezultat44 =@$conn->query("SELECT * FROM reviews where author_nick='$lgin'") ){
        if($rezultat44->num_rows>0){

        $i=0;
        while($wiersz44 = $rezultat44->fetch_assoc()){

          $idd[$i] = $wiersz44['id'];
          $tyt[$i] = $wiersz44['title'];
          $tytul[$i] = $wiersz44['review_title'];
          $zdj[$i]=$wiersz44['image'];
          $calytyt[$i] = $tytul[$i].' - Recenzja filmu '.$tyt[$i];

          $i=$i+1;
        }
        $reviews="";
        for ($x = $i-1; $x >=0; $x--) {
         $link ="review+".$idd[$x];
         $reviews .= "<a class='artik' href='reviews/$link.php'><p>$calytyt[$x] </p></a>";
       }

        }else{}
        $rezultat44->free_result();
      }else{}

    $conn->close();


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
  <div class="newsfeed2">
    <h2>twoje oceny</h2>
    <div class="filmys">
      <ul>$filmys
      </ul>
    </div>
  </div>
  <div class="newsfeed">
    <h2>Recenzje użytkownika</h2>
    <article>
       $reviews
    </article>
  </div>
END
?>

  </div>
</div>


</body>
</html>
