<?php
session_start();

require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      $query4="SELECT * FROM series";
      if($rezultat4 =@$polaczenie->query($query4) ){
        if($rezultat4->num_rows>0){

        $i=0;
        while($wiersz = $rezultat4->fetch_assoc()){

          $idd[$i] = $wiersz['id'];
          $tytul[$i]=$wiersz['series_title'];

          $startyear[$i]= $wiersz['start_year'];
          $endyear[$i]= $wiersz['end_year'];

          $i=$i+1;
        }
        $filmys="";
        for ($x = 0; $x < $i; $x++) {
          if($rezultat6 =@$polaczenie->query("SELECT AVG(grade) as avgrade FROM movies_rated WHERE title='$tytul[$x]' ") ){
            if($rezultat6->num_rows>0){

            $wiersz6 = $rezultat6->fetch_assoc();
            $srednia = $wiersz6['avgrade'];
            //$ocenaa = "Film oceniono na $ocenka / 5";
            $filmys .= "<li><a class='nv' href='series/$idd[$x].php'><div class='film-div'><div class='mini-poster'><img src='style/img/seriesposters/$idd[$x].jpg' alt='movie poster' style='width: 90px; height: 130px;'></div><div class='mini-info-box'><h3 class='tit'>$tytul[$x] ($startyear[$x] - $endyear[$x])</h3></div> <span id='srd'>Średnia ocena: $srednia </span></div></a></li>";

            }else{
            //  $ocenaa ="Nie oceniono tego filmu";
            }
            $rezultat6->free_result();
          }else{echo "<script type='text/javascript'>alert('chyuj');</script>";}


       }


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
  <link rel="stylesheet" href="style/pasek.css" type="text/css">
  <link rel="stylesheet" href="style/style.css" type="text/css">
  <style>
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
  </style>

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
    <a href="movies.php"><div class="top-btn">Filmy</div></a>
    <a href="#"><div class="top-btn">Seriale</div></a>
    <a href="#"><div class="top-btn">Ludzie kina</div></a>
    <a href="articles.php"><div class="top-btn">newsy</div></a>
    <a href="reviews.php"><div class="top-btn">Recenzje</div></a>
    <a href="trailers.php"><div class="top-btn">Zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed2">
      <h2>OSTATNIO DODANE SERIALE</h2>
      <div class="filmys">
        <ul>
          <?php echo $filmys; ?>

        </ul>
      </div>
    </div>
    </div>
  </div>

<footer><div id='ftr'>&copy; MovieLovie.com - Adam Tomczak (2019),  All rights reserved</div></footer>
</body>
</html>
