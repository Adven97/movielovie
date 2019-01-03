<?php
session_start();

require_once 'connect.php';

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $polaczenie->set_charset("utf8");

    if($polaczenie->connect_errno !=0){
      echo "Error ".$polaczenie->connect_errno;
    }
    else {

      $query4="SELECT * FROM movies";
      if($rezultat4 =@$polaczenie->query($query4) ){
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
        $filmys="";
        for ($x = 0; $x < $i; $x++) {
        // $actor_site =strtolower($actor_name[$x])."_".strtolower($actor_lname[$x]);
         $filmys .= "<li><a class='nv' href='movies/$idd[$x].php'><div class='film-div'><div class='mini-poster'><img src='style/img/$idd[$x].jpg' alt='movie poster' style='width: 90px; height: 130px;'></div><div class='mini-info-box'><h3 class='tit'>$tytul[$x] ($d[$x])</h3><i class='iii'>$dlugosc[$x] min</i></div></div></a></li>";
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
      height: 130px;
      width:100%;
      margin-left: 0px;
      margin-right: 0px;
      background-color: cyan
    }
    .film-div:hover{
      transform: scale(1.08);
      transition: .3s
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
      font-size: 23px;
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
    <a href="#"><div class="top-btn">filmy</div></a>
    <a href="#"><div class="top-btn">seriale</div></a>
    <a href="#"><div class="top-btn">ludzie kina</div></a>
    <a href="#"><div class="top-btn">newsy</div></a>
    <a href="#"><div class="top-btn">premiery</div></a>
    <a href="#"><div class="top-btn">zwiastuny</div></a>
    </div>
  </div>
    <div class="newsfeed2">
      <h2>OSTATNIO DODANE FILMY</h2>
      <div class="filmys">
        <ul>
          <?php echo $filmys; ?>
          <!-- <li>
            <a class="nv" href="movies/1.php">
            <div class="film-div">
              <div class="mini-poster">
                <img src="style/img/1.jpg" alt="movie poster" style='width: 90px; height: 130px;'>
              </div>
              <div class="mini-info-box">
                <h3 class="tit">$tytul ($d)</h3>
                <i class="iii">dlugosc</i>
              </div>
            </div></a>
          </li> -->
        </ul>
      </div>
    </div>
    </div>
  </div>


</body>
</html>
